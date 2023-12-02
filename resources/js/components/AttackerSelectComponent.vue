<template>
  <!-- ヘッダ -->
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-[#E76767] flex justify-center items-center">
      <h v-if="$i18n.locale === 'ja'" class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">悪用カード選択</h>
      <h1 v-else class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">Select 悪用カード</h1>
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
  <div v-if="$i18n.locale === 'ja'" class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center">
    <div class="flex flex-col justify-center items-center gap-y-[4vh] py-[6vh]">
      <button v-for="i in 3" :key="i" 
              :class="['w-[90vw] h-[20vh] bg-red-300 justify-start items-center px-[3vw] flex shadow-2xl relative',
                       selectedCard === i ? 'border-[5px] border-red-400' : '',
                       'hover:border-[5px] hover:border-red-400 duration-500']" 
              v-on:click="toggleCardSelection(i)">
        <img :src="`/img/${this['attackerCard' + i + 'Name']}.png`" alt="attacker_card" class="w-[16vh] h-[16vh]">
        <p class="text-[3vh] font-bold pl-[5vw]">{{ this['attackerCard' + i + 'Name'] }}</p>
        <button type="button" class="text-white font-bold text-[3vh] w-[3.5vh] h-[3.5vh] border-[2px] border-white rounded-full flex justify-center items-center absolute top-[1vh] right-[1vh] bg-red-500"
                @click.stop="openModal(i)">i</button>
      </button>
    </div>
    <button :disabled="!selectedCard" class="px-[20vw] py-2 bg-red-500 text-white rounded text-[3vh]" v-on:click="confirmSelection">決定</button>

    <!-- モーダル -->
    <div v-if="showModal && $i18n.locale === 'ja'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
      <div class="relative mx-auto p-2 border w-[85vw] shadow-lg rounded-md bg-white" @click.stop>
        <div class="mt-[2vh] text-center flex flex-col items-center justify-center">
          <h3 class="text-[3vh] leading-6 font-bold text-gray-900 mb-[1vh]">{{ selectedName }}</h3>
          <div class="mt-2 px-[8vw] py-[2vh] flex justify-center items-center">
            <p class="text-[2.5vh] text-gray-500">{{ selectedInfo }}</p>
          </div>
          <div class="items-center px-4 py-3">
            <button id="ok-btn" @click="closeModal" class="px-4 py-2 bg-red-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">閉じる</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 英語版 -->
  <div v-else class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center">
    <div class="flex flex-col justify-center items-center gap-y-[4vh] py-[6vh]">
      <button v-for="i in 3" :key="i" 
              :class="['w-[90vw] h-[20vh] bg-red-300 justify-start items-center px-[3vw] flex shadow-2xl relative',
                       selectedCard === i ? 'border-[5px] border-red-400' : '',
                       'hover:border-[5px] hover:border-red-400 duration-500']" 
              v-on:click="toggleCardSelection(i)">
        <img :src="`/img/${this['attackerCard' + i + 'Name']}.png`" alt="attacker_card" class="w-[16vh] h-[16vh]">
        <p class="text-[3vh] font-bold pl-[5vw]">{{ this['attackerCard' + i + 'Name'] }}</p>
        <button type="button" class="text-white font-bold text-[3vh] w-[3.5vh] h-[3.5vh] border-[2px] border-white rounded-full flex justify-center items-center absolute top-[1vh] right-[1vh] bg-red-500"
                @click.stop="openModal(i)">i</button>
      </button>
    </div>
    <button :disabled="!selectedCard" class="px-[20vw] py-2 bg-red-500 text-white rounded text-[3vh]" v-on:click="confirmSelection">Confirm</button>

    <!-- モーダル -->
    <div v-if="showModal && $i18n.locale === 'en'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
      <div class="relative mx-auto p-2 border w-[85vw] shadow-lg rounded-md bg-white" @click.stop>
        <div class="mt-[2vh] text-center flex flex-col items-center justify-center">
          <h3 class="text-[3vh] leading-6 font-bold text-gray-900 mb-[1vh]">{{ selectedName }}</h3>
          <div class="mt-2 px-[8vw] py-[2vh] flex justify-center items-center">
            <p class="text-[2.5vh] text-gray-500">{{ selectedInfo }}</p>
          </div>
          <div class="items-center px-4 py-3">
            <button id="ok-btn" @click="closeModal" class="px-4 py-2 bg-red-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">閉じる</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import MenuComponent from './MenuComponent.vue';

export default {
    components: {
      MenuComponent
    },
    data() {
      return {
        gameInformation: null,
        attackerCard1Name: null,
        attackerCard2Name: null,
        attackerCard3Name: null,
        attacker_card1Info: '',
        attacker_card2Info: '',
        attacker_card3Info: '',
        selectedCard: null,
        showModal: false,
        selectedInfo: '',
        selectedName: '',
        menuVisible: false,
      }
    },
    created() {
      axios.get(`/api/game/${this.$route.params.game_id}`)
        .then(response => {
          this.gameInformation = response.data;
          this.attackerCard1Name = this.gameInformation.attacker_card1.attacker_card_name;
          this.attackerCard2Name = this.gameInformation.attacker_card2.attacker_card_name;
          this.attackerCard3Name = this.gameInformation.attacker_card3.attacker_card_name;
          
          return axios.get(`/api/attacker-card-info/${this.attackerCard1Name}`);
        })
        .then(response => {
          this.attacker_card1Info = response.data.attacker_card_info;
          return axios.get(`/api/attacker-card-info/${this.attackerCard2Name}`);
        })
        .then(response => {
          this.attacker_card2Info = response.data.attacker_card_info;
          return axios.get(`/api/attacker-card-info/${this.attackerCard3Name}`);
        })
        .then(response => {
          this.attacker_card3Info = response.data.attacker_card_info;
        })
        .catch(error => {
          console.error(error);
        });
    },
    methods: {
      openModal(i) {
        this.selectedInfo = this['attacker_card' + i + 'Info']; // カードの情報をセット
        this.selectedName = this['attackerCard' + i + 'Name']; // カードの名前をセット
        this.showModal = true;
      },
      closeModal() {
        this.showModal = false;
      },
      toggleCardSelection(cardNumber) {
        if (this.selectedCard === cardNumber) {
          // すでに選択されているカードをもう一度クリックした場合、選択を解除
          this.selectedCard = null;
        } else {
          // 新しいカードをクリックした場合、選択を更新
          this.selectedCard = cardNumber;
        }
      },
      confirmSelection() {
        if (this.selectedCard) {
          const userId = this.$route.params.user_id;
          const gameId = this.$route.params.game_id;
          const opponentId = this.$route.query.opponent_id;
          const cardName = this['attackerCard' + this.selectedCard + 'Name'];

          axios.post('/api/attacker-select-card', { userId, cardName, opponentId })
            .then(response => {
              if(this.$route.query.talk == 'face'){
                this.$router.push({
                  path: `/attacker-standby/${userId}/${gameId}`,
                  query: {
                    opponent_id: opponentId,
                    attacker_select: cardName,
                    win_count: this.$route.query.win_count,
                  }
                });
              } else {
                this.$router.push({
                  path: `/attacker-chat/${userId}/${gameId}`,
                  query: {
                    opponent_id: opponentId,
                    attacker_select: cardName,
                    win_count: this.$route.query.win_count,
                  }
                });
              }
            })
            .catch(error => {
              console.error('エラーが発生しました', error);
            });
        }
      }
    }
  }
</script>