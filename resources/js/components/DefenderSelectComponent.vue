<template>
  <!-- ヘッダ -->
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-blue-500 flex justify-center items-center">
      <h1 v-if="$i18n.locale === 'ja'" class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">個人情報カード選択</h1>
      <h1 v-else class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">Select 個人情報カード</h1>
      <button @click="menuVisible = !menuVisible" class="text-white font-semibold text-[2.5vh] w-[3.5vh] h-[3.5vh] border-[3px] border-white rounded-full flex justify-center items-center mr-[5vw]">？</button>
      <MenuComponent
        v-model:modelValue="menuVisible"
        :gameId="parseInt($route.params.game_id)"
        :userId="parseInt($route.params.user_id)"
        :role="'defender'"
      />
    </div>
  </div>

  <!-- 日本語版 -->
  <div v-if="$i18n.locale === 'ja'" class="bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div class=" flex items-center justify-center text-[2vh]">
      <p className="text-blue-600 font-bold mr-[6vw]">残り時間 : {{ timeLeft }}</p>
      <button 
        :disabled="selectedCards.length !== 3" 
        @click="confirmSelection" 
        class="text-white font-bold py-[6px] px-[2vw] my-[2vh] border-[3px] border-blue-500 hover:border-blue-600
        hover:bg-blue-600 bg-blue-500 duration-300 shadow-sm rounded"
        :class="{ 'opacity-50 cursor-not-allowed': selectedCards.length !== 3 }">
        公開するカードを決定
      </button>
    </div>
    <ul class="flex flex-col gap-x-5 justify-center items-center gap-y-[2vh] pb-[3vh]">
      <li v-for="(card, index) in defenderCards" :key="card.id" :class="{ 'selected-border': selectedCards.includes(index + 1) }">
        <button @click="selectCard(index + 1)" class="w-[90vw] h-[14vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[12vh] h-[12vh]">
          <p className="text-[3vh] font-bold pl-[3vw]">{{ card.defender_card_name }}</p>
        </button>
      </li>
    </ul>
  </div>

  <!-- 英語版 -->
  <div v-else class="bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div class=" flex items-center justify-center text-[2vh]">
      <p className="text-blue-600 font-bold mr-[6vw]">Time Left : {{ timeLeft }}</p>
      <button 
        :disabled="selectedCards.length !== 3" 
        @click="confirmSelection" 
        class="text-white font-bold py-[6px] px-[2vw] my-[2vh] border-[3px] border-blue-500 hover:border-blue-600
        hover:bg-blue-600 bg-blue-500 duration-300 shadow-sm rounded"
        :class="{ 'opacity-50 cursor-not-allowed': selectedCards.length !== 3 }">
        公開するカードを決定
      </button>
    </div>
    <ul class="flex flex-col gap-x-5 justify-center items-center gap-y-[2vh] pb-[3vh]">
      <li v-for="(card, index) in defenderCards" :key="card.id" :class="{ 'selected-border': selectedCards.includes(index + 1) }">
        <button @click="selectCard(index + 1)" class="w-[90vw] h-[14vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[12vh] h-[12vh]">
          <p className="text-[3vh] font-bold pl-[3vw]">{{ card.defender_card_name }}</p>
        </button>
      </li>
    </ul>
  </div>

  <!-- 対話開始モーダル 日本語 -->
  <div v-if="startModal && $i18n.locale === 'ja'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">対話開始</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">あなたが「他人に知られても良い」と感じる個人情報カードを、対戦相手と対話しながら3枚選択してください。制限時間は５分です。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeStartModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
          開始する
        </button>
      </div>
    </div>
  </div>

  <!-- 対話開始モーダル 英語 -->
  <div v-if="startModal && $i18n.locale === 'en'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">Start Conversation</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">あなたが「他人に知られても良い」と感じる個人情報カードを、対戦相手と対話しながら3枚選択してください。制限時間は５分です。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeStartModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
          開始する
        </button>
      </div>
    </div>
  </div>

  <!-- 対話終了モーダル 日本語 -->
  <div v-if="finishModal && $i18n.locale === 'ja'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">対話終了</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">制限時間の５分を経過しました。悪用サイドに渡す個人情報カードを3枚選択し、次の画面に進んでください。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeFinishModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
          閉じる
        </button>
      </div>
    </div>
  </div>

  <!-- 対話終了モーダル 英語 -->
  <div v-if="finishModal && $i18n.locale === 'en'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">Finish Conversation</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">制限時間の５分を経過しました。悪用サイドに渡す個人情報カードを3枚選択し、次の画面に進んでください。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeFinishModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
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
        const cardInfoResponse = await axios.get(`/api/attacker-card-info/${this.gameId}/${decodeURIComponent(this.$route.query.selected_card)}`);
        this.attacker_select_id = cardInfoResponse.data.attackerCardNumber;
      } catch (error) {
        console.error('Error fetching game information:', error);
      }
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
      selectCard(cardNumber) {
        if (this.selectedCards.includes(cardNumber)) {
          this.selectedCards = this.selectedCards.filter(card => card !== cardNumber);
        } else if (this.selectedCards.length < 3) {
          this.selectedCards.push(cardNumber);
        }
      },
      confirmSelection() {
        if (this.selectedCards.length === 3) {
          axios.post('/api/defender-select-card', {
            user_id: this.$route.params.user_id,
            opponent_id: this.$route.query.opponent_id,
            selected_cards: this.selectedCards
          }).then(() => {
            this.$router.push({
              path: `/result/${this.$route.params.user_id}/${this.$route.params.game_id}/`,
              query: {
                selectedCards: this.selectedCards,
                win_count: this.$route.query.win_count,
                role: 'defender',
                attacker_select_id: this.attacker_select_id,
                opponent_id: this.$route.query.opponent_id
              },
            });
          }).catch(error => {
            console.error('カード情報の送信に失敗しました', error);
          });
        } else {
          console.error('3枚のカードが選択されていません');
        }
      },
      closeStartModal() {
        this.startModal = false;
        const transit = true;
        const opponentId = this.$route.query.opponent_id;
        axios.post('/api/defender-transit', { transit, opponentId })
          .catch(error => {
            console.error('エラーが発生しました', error);
          });
        this.startCountdown();
      },
      closeFinishModal() {
        this.finishModal = false;
      }
    }
  }
</script>

<style>
.selected-border {
  border: 3px solid #3b82f6;
}
</style>