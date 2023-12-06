<template>
  <!-- ヘッダ -->
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-green-600 flex justify-center items-center">
      <h1 v-if="$i18n.locale === 'ja'" class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">配点内訳</h1>
      <h1 v-else class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">Score 内訳</h1>
      <button @click="menuVisible = !menuVisible" class="text-white font-semibold text-[2.5vh] w-[3.5vh] h-[3.5vh] border-[3px] border-white rounded-full flex justify-center items-center mr-[5vw]">？</button>
      <MenuComponent
        v-model:modelValue="menuVisible"
        :gameId="parseInt($route.params.game_id)"
        :userId="parseInt($route.params.user_id)"
        :role="$route.query.role"
      />
    </div>
  </div>

  <!-- 日本語版 -->
  <div v-if="$i18n.locale === 'ja'" class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center">
    <p class="text-[2vh] mx-[5vw] pt-[1.5vh]"><span class="font-bold text-red-500">「{{ attackerCardName }}」</span>にとって重要そうなカードを下のように配点したよ！あなただったらどう設定するか教えてね。参考にするよ！</p>
    <div class="flex">
      <div class="flex flex-col items-center gap-y-[2vh] pt-[3vh] pb-[3vh]">
        <div v-for="cardName in [defenderCard1Name, defenderCard2Name, defenderCard3Name, defenderCard4Name, defenderCard5Name]" :key="cardName" class="w-[60vw] h-[12vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${cardName}.png`" alt="defender_card" class="w-[10vh] h-[10vh]">
          <p class="text-[2vh] font-bold pl-[2vw]">{{ cardName }}</p>
        </div>
      </div>
      <div class="flex flex-col items-center text-[2vh] mx-[3vw] font-bold">
        <p class="text-[2vh]">配点</p>
        <div class="flex flex-col items-center gap-y-[2vh]">
          <p v-for="(score, index) in [scores?.defender_card1_score, scores?.defender_card2_score, scores?.defender_card3_score, scores?.defender_card4_score, scores?.defender_card5_score]" :key="index" class="w-[10vw] h-[12vh] flex justify-center items-center">{{ score }}</p>
        </div>
      </div>
      <form class="flex flex-col items-center text-[2vh] my-0 py-0">
        <p class="font-bold">あなた</p>
        <div class="flex flex-col items-center gap-y-[2vh]">
          <div v-for="(cardScore, index) in ['card1', 'card2', 'card3', 'card4', 'card5']" :key="index" class="flex items-center w-[15vw] h-[12vh] justify-center">
            <label :for="`${cardScore}Score`"></label>
            <select v-model="cardScores[cardScore]" class="border border-blue-500" :id="`${cardScore}Score`">
              <option v-for="score in scoreOptions[cardScore]" :key="score" :value="score">{{ score }}</option>
            </select>            
            点
          </div>
        </div>
      </form>
    </div>
    <div v-if="parseInt($route.params.game_id) < 6 && parseInt($route.params.user_id) < 31" class="flex justify-end">
      <button @click="submitScores" class="text-white font-bold py-[1vh] px-[20vw] border-[3px] border-green-600 hover:border-green-700 hover:bg-green-700 bg-green-600 duration-300 shadow-xl text-[2vh]">
        もう一度対戦する
      </button>
    </div>
    <div v-if="parseInt($route.params.game_id) == 6 || parseInt($route.params.user_id) > 30" class="flex justify-end">
      <button @click="submitScores6" class="border-[3px] border-green-600 text-green-600 font-bold py-[1vh] px-[20vw] hover:bg-blue-500 hover:text-white duration-300 shadow-xl text-[2vh]">
        ゲームを終了する
      </button>
    </div>
    <!-- モーダル -->
    <div v-if="isModalVisible && $i18n.locale === 'ja'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
      <div class="relative mx-auto p-1 border w-[90vw] shadow-lg rounded-md bg-white">
        <div class="mt-[2vh] text-center flex flex-col items-center justify-center">
          <img src='/img/tips.png' class="w-[70vw]">
          <div class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center">
            <p class="text-[2vh] text-gray-500 notice"></p>
          </div>
          <div class="items-center px-4 py-3">
            <button id="ok-btn" @click="closeModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">閉じる</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 英語版 -->
  <div v-else class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center">
    <p class="text-[2vh] mx-[5vw] pt-[1.5vh]"><span class="font-bold text-red-500">「{{ attackerCardName }}」</span>にとって重要そうなカードを下のように配点したよ！Youだったらどう設定するか教えてね。参考にするよ！</p>
    <div class="flex">
      <div class="flex flex-col items-center gap-y-[2vh] pt-[3vh] pb-[3vh]">
        <div v-for="cardName in [defenderCard1Name, defenderCard2Name, defenderCard3Name, defenderCard4Name, defenderCard5Name]" :key="cardName" class="w-[60vw] h-[12vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${cardName}.png`" alt="defender_card" class="w-[10vh] h-[10vh]">
          <p class="text-[2vh] font-bold pl-[2vw]">{{ cardName }}</p>
        </div>
      </div>
      <div class="flex flex-col items-center text-[2vh] mx-[3vw] font-bold">
        <p class="text-[2vh]">配点</p>
        <div class="flex flex-col items-center gap-y-[2vh]">
          <p v-for="(score, index) in [scores?.defender_card1_score, scores?.defender_card2_score, scores?.defender_card3_score, scores?.defender_card4_score, scores?.defender_card5_score]" :key="index" class="w-[10vw] h-[12vh] flex justify-center items-center">{{ score }}</p>
        </div>
      </div>
      <form class="flex flex-col items-center text-[2vh] my-0 py-0">
        <p class="font-bold">あなた</p>
        <div class="flex flex-col items-center gap-y-[2vh]">
          <div v-for="(cardScore, index) in ['card1', 'card2', 'card3', 'card4', 'card5']" :key="index" class="flex items-center w-[15vw] h-[12vh] justify-center">
            <label :for="`${cardScore}Score`"></label>
            <select v-model="cardScores[cardScore]" class="border border-blue-500" :id="`${cardScore}Score`">
              <option v-for="score in scoreOptions[cardScore]" :key="score" :value="score">{{ score }}</option>
            </select>
            点
          </div>
        </div>
      </form>
    </div>
    <div v-if="parseInt($route.params.game_id) < 6" class="flex justify-end">
      <button @click="submitScores" class="text-white font-bold py-[1vh] px-[20vw] border-[3px] border-green-600 hover:border-green-700 hover:bg-green-700 bg-green-600 duration-300 shadow-xl text-[2vh]">
        もう一度対戦する
      </button>
    </div>
    <div v-if="parseInt($route.params.game_id) == 6" class="flex justify-end">
      <button @click="submitScores6" class="border-[3px] border-green-600 text-green-600 font-bold py-[1vh] px-[20vw] hover:bg-green-600 hover:text-white duration-300 shadow-xl text-[2vh]">
        ゲームを終了する
      </button>
    </div>
    <!-- モーダル -->
    <div v-if="isModalVisible && $i18n.locale === 'en'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
      <div class="relative mx-auto p-1 border w-[90vw] shadow-lg rounded-md bg-white">
        <div class="mt-[2vh] text-center flex flex-col items-center justify-center">
          <img src='/img/tips.png' class="w-[70vw]">
          <div class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center">
            <p class="text-[2vh] text-gray-500 notice"></p>
          </div>
          <div class="items-center px-4 py-3">
            <button id="ok-btn" @click="closeModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">Close</button>
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
      scores: {},
      gameInformation: null,
      defenderCardNames: {},
      attackerCardName: '',
      username: '',
      defenderCard1Name: null,
      defenderCard2Name: null,
      defenderCard3Name: null,
      defenderCard4Name: null,
      defenderCard5Name: null,
      gameIdforPath: this.$route.params.game_id,
      scoreOptions: this.initializeScoreOptions(),
      cardScores: this.initializeCardScores(),
      menuVisible: false,
      isModalVisible: false,
      notice: '',
    };
  },
  created() {
    this.fetchGameInformation();
    this.fetchScores();
    this.isModalVisible = true;
  },
  methods: {
    fetchGameInformation() {
      const gameId = this.$route.params.game_id;
      const attackerSelectId = this.$route.query.attacker_select_id;

      axios.get(`/api/getGame/${gameId}?attacker_select_id=${attackerSelectId}`)
        .then(response => {
          this.attackerCardName = response.data.attacker_card_name;
        })
        .catch(error => {
          console.error(error);
        });

      axios.get(`/api/game/${gameId}`)
        .then(response => {
          this.gameInformation = response.data;
          this.defenderCard1Name = this.gameInformation.defender_card1.defender_card_name;
          this.defenderCard2Name = this.gameInformation.defender_card2.defender_card_name;
          this.defenderCard3Name = this.gameInformation.defender_card3.defender_card_name;
          this.defenderCard4Name = this.gameInformation.defender_card4.defender_card_name;
          this.defenderCard5Name = this.gameInformation.defender_card5.defender_card_name;
        })
        .catch(error => {
          console.error(error);
        });

      axios.get(`/api/notice/${gameId}`)
        .then(response => {
          this.notice = response.data.notice_content;
          var element = document.querySelector('.notice');
          element.innerHTML = this.notice;
        })
        .catch(error => {
          console.error(error);
        });
    },
    fetchScores() {
      const gameId = this.$route.params.game_id;
      const attackerSelectId = this.$route.query.attacker_select_id;

      axios.get(`/api/getScore/${gameId}?attacker_select_id=${attackerSelectId}`)
        .then(response => {
          this.scores = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    async submitScores() {
      if (this.calculateTotalScore() !== 100) {
        alert('※100点満点になるよう配点を考えてください');
        return;
      }
      try {
        await this.processScoreSubmission(`/introduction/${this.$route.params.user_id}/${parseInt(this.$route.params.game_id) + 1}`);
      } catch (error) {
        console.error('Error submitting scores:', error);
      }
    },
    async submitScores6() {
      if (this.calculateTotalScore() !== 100) {
        alert('※100点満点になるよう配点を考えてください');
        return;
      }
      try {
        await this.processScoreSubmission('/final-result');
      } catch (error) {
        console.error('Error submitting scores:', error);
      }
    },
    async processScoreSubmission(path) {
      const gameId = this.$route.params.game_id;
      const attackerSelectId = this.$route.query.attacker_select_id;
      
      try {
        const userResponse = await axios.get(`/api/users/${this.$route.params.user_id}`);
        this.username = userResponse.data.username;

        await axios.post(`/api/user_scores`, {
          game_id: gameId,
          attacker_select_id: attackerSelectId,
          user_name: this.username,
          user_card1_score: this.cardScores.card1,
          user_card2_score: this.cardScores.card2,
          user_card3_score: this.cardScores.card3,
          user_card4_score: this.cardScores.card4,
          user_card5_score: this.cardScores.card5,
        });

        this.$router.push({
          path: path,
          query: {    
            win1: this.$route.query.win1,
            win2: this.$route.query.win2,
            win3: this.$route.query.win3,
            win4: this.$route.query.win4,
            win5: this.$route.query.win5,
            win6: this.$route.query.win6
          }
        });
      } catch (error) {
        console.error('Error during score submission:', error);
      }
    },
    initializeScoreOptions() {
      let options = {};
      for (let i = 1; i <= 5; i++) {
        options[`card${i}`] = this.generateScoreOptions(100);
      }
      return options;
    },
    initializeCardScores() {
      return {
        card1: 0,
        card2: 0,
        card3: 0,
        card4: 0,
        card5: 0
      };
    },
    generateScoreOptions(maxScore) {
      let options = [];
      for (let i = 0; i <= maxScore; i += 5) {
        options.push(i);
      }
      return options;
    },
    updateScoreOptions(selectedCard) {
      const totalScore = 100;
      let usedScore = Object.values(this.cardScores).reduce((acc, value) => acc + value, 0);

      for (let card in this.scoreOptions) {
        if (card !== selectedCard) {
          let remainingScore = totalScore - usedScore + this.cardScores[card];
          this.scoreOptions[card] = this.generateScoreOptions(remainingScore);
        }
      }
    },
    calculateTotalScore() {
      return this.cardScores.card1 + this.cardScores.card2 +
             this.cardScores.card3 + this.cardScores.card4 +
             this.cardScores.card5;
    },
    closeModal() {
      this.isModalVisible = false;
    }
  },
  watch: {
    'cardScores.card1'(newVal) {
      this.cardScores.card1 = parseInt(newVal) || 0;
      this.updateScoreOptions('card1');
    },
    'cardScores.card2'(newVal) {
      this.cardScores.card2 = parseInt(newVal) || 0;
      this.updateScoreOptions('card2');
    },
    'cardScores.card3'(newVal) {
      this.cardScores.card3 = parseInt(newVal) || 0;
      this.updateScoreOptions('card3');
    },
    'cardScores.card4'(newVal) {
      this.cardScores.card4 = parseInt(newVal) || 0;
      this.updateScoreOptions('card4');
    },
    'cardScores.card5'(newVal) {
      this.cardScores.card5 = parseInt(newVal) || 0;
      this.updateScoreOptions('card5');
    }
  }
};
</script>
