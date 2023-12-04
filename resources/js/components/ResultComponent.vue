<template>
  <!-- ヘッダ -->
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-green-600 flex justify-center items-center">
      <h1 v-if="$i18n.locale === 'ja'" class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">結果</h1>
      <h1 v-else class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">Result</h1>
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
  <div v-if="$i18n.locale === 'ja'" class="flex flex-col items-center bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div class="flex flex-col items-center pt-[1vh] pb-[1vh]" id="result">
      <img :src="`/img/${resultImage}.png`" alt="result" class="w-[25vw] h-[25vw]">
    </div>
    <div class="flex flex-col justify-center items-center gap-y-1">
      <p class="text-[2.5vh]">あなたの得点:{{ 100 - score }}点</p>
      <p class="text-[2.5vh]">相手の得点:{{ score }}点</p>
    </div>
    <div class="flex flex-col justify-center items-center gap-y-[1.5vh] py-[2vh]">
      <div class="w-[90vw] h-[13vh] bg-red-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
        <img :src="`/img/${attackerCardName}.png`" alt="attacker_card" class="w-[11vh] h-[11vh]">
        <p class="text-[2.7vh] font-bold pl-[3vw]">{{ attackerCardName }}</p>
      </div>
      <div v-for="(defenderSelect, index) in defenderSelects" :key="index" class="w-[90vw] h-[13vh] bg-blue-300 px-[3vw] duration-500 shadow-2xl flex justify-between items-center">
        <div class="flex justify-start items-center">
          <img :src="`/img/${defenderSelect}.png`" alt="defender_card" class="w-[10vh] h-[10vh]">
          <p class="text-[2.7vh] font-bold pl-[3vw]">{{ defenderSelect }}</p>
        </div>
        <p class="text-[2.7vh] font-bold">{{ individualScores[`card${$route.query.selectedCards[index]}`] }}点</p>
      </div>  
    </div>
    <router-link :to="{ name: 'user-score', params: { user_id: $route.params.user_id, game_id: $route.params.game_id }, query: { attacker_select_id: $route.query.attacker_select_id, role: $route.query.role, win1: win1, win2: win2, win3: win3, win4: win4, win5: win5, win6: win6 } }"
      class="bg-green-600 text-white font-bold py-[1vh] px-[20vw] text-[2vh] shadow-md hover:bg-green-700 duration-300">
      配点を見る
    </router-link>
  </div>

  <!-- 英語版 -->
  <div v-else class="flex flex-col items-center bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div class="flex flex-col items-center pt-[1vh] pb-[1vh]" id="result">
      <img :src="`/img/${resultImage}.png`" alt="result" class="w-[25vw] h-[25vw]">
    </div>
    <div class="flex flex-col justify-center items-center gap-y-1">
      <p class="text-[2.5vh]">Your Score:{{ 100 - score }}点</p>
      <p class="text-[2.5vh]">相手の得点:{{ score }}点</p>
    </div>
    <div class="flex flex-col justify-center items-center gap-y-[1.5vh] py-[2vh]">
      <div class="w-[90vw] h-[13vh] bg-red-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
        <img :src="`/img/${attackerCardName}.png`" alt="attacker_card" class="w-[11vh] h-[11vh]">
        <p class="text-[2.7vh] font-bold pl-[3vw]">{{ attackerCardName }}</p>
      </div>
      <div v-for="(defenderSelect, index) in defenderSelects" :key="index" class="w-[90vw] h-[13vh] bg-blue-300 px-[3vw] duration-500 shadow-2xl flex justify-between items-center">
        <div class="flex justify-start items-center">
          <img :src="`/img/${defenderSelect}.png`" alt="defender_card" class="w-[10vh] h-[10vh]">
          <p class="text-[2.7vh] font-bold pl-[3vw]">{{ defenderSelect }}</p>
        </div>
        <p class="text-[2.7vh] font-bold">{{ individualScores[`card${$route.query.selectedCards[index]}`] }}点</p>
      </div>  
    </div>
    <router-link :to="{ name: 'user-score', params: { user_id: $route.params.user_id, game_id: $route.params.game_id }, query: { attacker_select_id: $route.query.attacker_select_id, role: $route.query.role, win1: win1, win2: win2, win3: win3, win4: win4, win5: win5, win6: win6, } }"
      class="bg-green-600 text-white font-bold py-[1vh] px-[20vw] text-[2vh] shadow-md hover:bg-green-700 duration-300">
      配点を見る
    </router-link>
  </div>
</template>

<script>
import axios from 'axios'
import MenuComponent from './MenuComponent.vue';

export default {
  components: {
    MenuComponent
  },
  name: "ResultComponent",
  data() {
    return {
      score: 0,
      result: '',
      username: '',
      resultImage: '',
      win1: this.$route.query.win1,
      win2: this.$route.query.win2,
      win3: this.$route.query.win3,
      win4: this.$route.query.win4,
      win5: this.$route.query.win5,
      win6: this.$route.query.win6,
      menuVisible: false,
      attackerCardName: '',
      individualScores: {},
      defenderCards: [],
      defenderSelects: []
    };
  },
  methods: {
    async sendGameResult(defenderSelects, calculatedScore) {
      const attackerScore = 100 - calculatedScore;
      try {
        const userResponse = await axios.get(`/api/users/${this.$route.params.user_id}`);
        this.username = userResponse.data.username;

        const opponentResponse = await axios.get(`/api/users/${this.$route.query.opponent_id}`);
        this.attackername = opponentResponse.data.username;

        await axios.post(`/api/users/${this.$route.params.user_id}/update-waiting-status`, {
          is_waiting: false
        });
        
        if(this.$route.query.role == 'defender') {
          axios.post('/api/game-result', {
            attacker_name: this.attackername,
            defender_name: this.username,
            game_id: this.$route.params.game_id,
            attacker_select_id: this.$route.query.attacker_select_id,
            defender_select_1: defenderSelects[1] || false,
            defender_select_2: defenderSelects[2] || false,
            defender_select_3: defenderSelects[3] || false,
            defender_select_4: defenderSelects[4] || false,
            defender_select_5: defenderSelects[5] || false,
            attacker_score: attackerScore,
            defender_score: calculatedScore,
          });
        }
      } catch (error) {
        console.error(error);
      }
    }
  },
  mounted() {
    const gameId = this.$route.params.game_id;
    const selectedCardsArray = this.$route.query.selectedCards;
    let selectedCardsBoolean = {1: false, 2: false, 3: false, 4: false, 5: false};
    selectedCardsArray.forEach(card => {
      selectedCardsBoolean[card] = true;
    });

    const attackerSelectId = this.$route.query.attacker_select_id;
    
    axios.get(`/api/game/${gameId}`)
    .then(response => {
      const gameData = response.data;
      this.attackerCardName = gameData[`attacker_card${attackerSelectId}`].attacker_card_name;

      this.defenderSelects = this.$route.query.selectedCards.map(cardIndex => {
        return gameData[`defender_card${cardIndex}`].defender_card_name;
      });
    })
    .catch(error => {
      console.error(error);
    });


    axios.get(`/api/score/${gameId}`, {
      params: { selectedCards: selectedCardsArray, attacker_select_id: attackerSelectId },
    })
    .then((response) => {
      this.individualScores = response.data.individualScores;
      if(this.$route.query.role == 'defender'){
        this.score = response.data.totalScore;
      } else {
        this.score = 100 - response.data.totalScore;
      }
      if(this.score < 50){
        this.resultImage = 'win';
        this[`win${gameId}`] = '○';
      } else if(this.score === 50){
        this.result = '引き分け';
        this.resultImage = 'draw';
        this[`win${gameId}`] = '△';
      } else {
        this.resultImage = 'lose';
        this[`win${gameId}`] = '×';
      }

      this.sendGameResult(selectedCardsBoolean, this.score);
    })
  },
};
</script>
