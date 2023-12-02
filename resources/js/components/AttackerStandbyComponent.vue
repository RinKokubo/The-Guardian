<template>
  <!-- ヘッダ -->
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-[#E76767] flex justify-center items-center">
      <h1 v-if="$i18n.locale === 'ja'" class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">個人情報カード選択</h1>
      <h1 v-else class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">Select 個人情報カード</h1>
      <button @click="menuVisible = !menuVisible" class="text-white font-semibold text-[2.5vh] w-[3.5vh] h-[3.5vh] border-[3px] border-white rounded-full flex justify-center items-center mr-[5vw]">？</button>
      <MenuComponent
        v-model:modelValue="menuVisible"
        :gameId="parseInt($route.params.game_id)"
        :userId="parseInt($route.params.user_id)"
        :role="'attacker'"
      />
    </div>
  </div>

  <!-- 日本語版 -->
  <div v-if="$i18n.locale === 'ja'" class="bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <p className="font-bold flex items-center justify-center text-[2.5vh] pt-[2vh] text-red-500">残り時間 : {{ timeLeft }}</p>
    <p class="flex items-center justify-center text-[2vh] py-[1vh] px-[5vw]">対戦相手が公開する個人情報カードを選択中です。</p>
    <ul class="flex flex-col gap-x-5 justify-center items-center gap-y-[2vh] pb-[3vh]">
      <li v-for="(card) in defenderCards" :key="card.id">
        <div class="w-[90vw] h-[14vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[12vh] h-[12vh]">
          <p className="text-[3vh] font-bold pl-[3vw]">{{ card.defender_card_name }}</p>
        </div>
      </li>
    </ul>
  </div>

  <!-- 英語版 -->
  <div v-else class="bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <p className="font-bold flex items-center justify-center text-[2.5vh] pt-[2vh] text-red-500">Time Left : {{ timeLeft }}</p>
    <p class="flex items-center justify-center text-[2vh] py-[1vh] px-[5vw]">対戦相手が公開する個人情報カードを選択中です。</p>
    <ul class="flex flex-col gap-x-5 justify-center items-center gap-y-[2vh] pb-[3vh]">
      <li v-for="(card) in defenderCards" :key="card.id">
        <div class="w-[90vw] h-[14vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[12vh] h-[12vh]">
          <p className="text-[3vh] font-bold pl-[3vw]">{{ card.defender_card_name }}</p>
        </div>
      </li>
    </ul>
  </div>

  <!-- 対話開始モーダル 日本語 -->
  <div v-if="startModal && $i18n.locale === 'ja'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">対話開始</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">対戦相手には手口を悟られないように、それぞれの個人情報カードに対する考えを対話してください。制限時間は5分です。</p>
    </div>
  </div>

  <!-- 対話開始モーダル 英語 -->
  <div v-if="startModal && $i18n.locale === 'en'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">Start Conversation</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">対戦相手には手口を悟られないように、それぞれの個人情報カードに対する考えを対話してください。制限時間は5分です。</p>
    </div>
  </div>

  <!-- 対話終了モーダル 日本語 -->
  <div v-if="finishModal && $i18n.locale === 'ja'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">対話終了</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">制限時間の５分を経過しました。個人情報提供サイドに個人情報カードを3枚選択するよう伝えてください。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
          閉じる
        </button>
      </div>
    </div>
  </div>

  <!-- 対話終了モーダル 英語 -->
  <div v-if="finishModal && $i18n.locale === 'en'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">Finish Conversation</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">制限時間の５分を経過しました。個人情報提供サイドに個人情報カードを3枚選択するよう伝えてください。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
          閉じる
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import MenuComponent from './MenuComponent.vue';

export default {
  components: {
    MenuComponent
  },
    data() {
      return {
        defenderCards: [],
        selectedCards: [],
        countdownTime: 5 * 60,
        timeLeft: '05:00',
        menuVisible: false,
        finishModal: false,
        startModal: true,
      }
    },
    async created() {
      try {
        this.gameId = this.$route.params.game_id;
        const response = await axios.get(`/api/game/${this.gameId}`);
        this.defenderCards = [
          response.data.defender_card1,
          response.data.defender_card2,
          response.data.defender_card3,
          response.data.defender_card4,
          response.data.defender_card5,
        ];

        Echo.private(`user.${this.$route.params.user_id}`)
            .listen('.defender.transit', (event) => {
              this.startModal = false;
              this.startCountdown();
        });
        const cardInfoResponse = await axios.get(`/api/attacker-card-info/${this.gameId}/${decodeURIComponent(this.$route.query.attacker_select)}`);
        this.attacker_select_id = cardInfoResponse.data.attackerCardNumber;
      } catch (error) {
        console.error('Error fetching game information:', error);
      }
    },
    mounted() {
      Echo.private(`user.${this.$route.params.user_id}`)
      .listen('.defenderCards.selected', (event) => {
        this.selectedCards = event.selectedCards;
        this.$router.push({
          path: `/result/${this.$route.params.user_id}/${this.$route.params.game_id}/`,
          query: {
            selectedCards: this.selectedCards,
            attacker_select_id: this.attacker_select_id,
            win_count: this.$route.query.win_count,
            role: 'attacker',
            opponent_id: this.$route.query.opponent_id,
          },
        });
      });
    },
    methods: {
      startCountdown() {
        const timerInterval = setInterval(() => {
          if (this.countdownTime === 0) {
            clearInterval(timerInterval);
            this.finishModal = true
          } else {
            this.countdownTime--;
            this.formatTimeLeft();
          }
        }, 1000);
      },
      formatTimeLeft() {
        const minutes = Math.floor(this.countdownTime / 60);
        const seconds = this.countdownTime % 60;
        this.timeLeft = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
      },
      closeModal() {
        this.finishModal = false;
      }
    }
  }
</script>
