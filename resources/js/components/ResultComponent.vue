<template>
  <div class="flex w-[100vw] h-[10vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-[#E76767] flex justify-center items-center">
      <h1 className="w-[100%] text-[4vh] font-bold ml-[40px] text-white">結果</h1>
    </div>
  </div>
  <div className="flex flex-col items-center bg-[#E5E5E5] w-[100vw] h-[90vh]">
    <div className="flex justify-between items-center" id="result">
      <h1 className="desktop:text-[60px] sp:text-[26px] text-blue-600 mt-[100px] mb-[20px] desktop:text-left sp:text-center">
        {{ result }}
      </h1>
    </div>
    <div className="flex desktop:flex-row sp:flex-col desktop:justify-between sp:justify-center gap-x-10 gap-y-5 mb-[20px]">
      <p className="desktop:text-left sp:text-center text-[24px] desktop:w-[350px] sp:w-[100%]">あなたの得点:{{ 100 - score }}</p>
      <p className="desktop:text-left sp:text-center text-[24px] desktop:w-[350px] sp:w-[100%]">相手の得点:{{ score }}</p>
    </div>
    <div className="flex flex-col items-center mx-[80px] my-[40px] border-red-600 border-[3px] rounded py-[20px] px-[15px]">
      <p className="text-red-600 mb-[20px] font-bold text-[24px]">注意！</p>
      <p className="text-[18px]">{{ notice }}</p>
    </div>
    <router-link :to="{ name: 'user-score', params: { userId: $route.params.user_id, gameId: $route.params.game_id }, query: { attacker_select_id: $route.query.attacker_select_id } }"
      className="bg-blue-500 text-white font-bold py-[10px] px-[70px] shadow-md hover:bg-blue-600 duration-300">
      配点を見る
    </router-link>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "ResultComponent",
  data() {
    return {
      score: 0,
      result: '',
      notice: '',
      username: ''
    };
  },
  methods: {
    sendGameResult(defenderSelects, calculatedScore) {
      const attackerScore = 100 - calculatedScore;

      const userResponse = axios.get(`http://localhost:8000/api/users/${this.$route.params.user_id}`);
      this.username = userResponse.data.username;
      
      axios.post('/api/game-result', {
        attacker_name: 'chatGPT',
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
  },
  mounted() {
    const gameId = this.$route.params.game_id;
    let selectedCards = this.$route.query.selectedCards;

    const selectedCardsArray = this.$route.query.selectedCards;
    let selectedCardsBoolean = {1: false, 2: false, 3: false, 4: false, 5: false};
    selectedCardsArray.forEach(card => {
      selectedCardsBoolean[card] = true;
    });

    const attackerSelectId = this.$route.query.attacker_select_id;
    const noticeId = Math.floor(Math.random() * 9) + 1;

    axios.get(`/api/score/${gameId}`, {
      params: { selectedCards, attacker_select_id: attackerSelectId },
    })
    .then((response) => {
      this.score = response.data.score;
      if(this.score < 50){
        this.result = 'あなたの勝利！';
      } else if(this.score === 50){
        this.result = '引き分け';
      } else {
        this.result = 'あなたの負け...';
      }

      this.sendGameResult(selectedCardsBoolean, this.score);
    })

    axios.get(`/api/notice/${noticeId}`)
      .then((response) => {
        this.notice = response.data.notice_content;
      })
      .catch((error) => {
        console.error(error);
      });
  },
};
</script>
