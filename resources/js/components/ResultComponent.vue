<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-green-600 flex justify-center items-center">
      <h1 className="w-[100%] text-[3vh] font-bold ml-[40px] text-white">結果</h1>
    </div>
  </div>
  <div className="flex flex-col items-center bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div className="flex flex-col items-center pt-[3vh] pb-[1vh]" id="result">
      <img :src="`/img/${resultImage}.png`" alt="result" class="w-[40vw] h-[40vw]">
    </div>
    <div className="flex flex-col justify-center gap-y-3">
      <p className="text-left text-[3vh]">あなたの得点:  {{ 100 - score }}点</p>
      <p className="text-left text-[3vh]">相手の得点:  {{ score }}点</p>
    </div>
    <div v-if="this.$route.params.game_id == 6" class="flex flex-col justify-center items-center gap-y-5 mt-[3vh] mb-[5vh] text-[3vh] font-bold">
      <p>最終結果</p>
      <p>あなたのランク： {{ this.$route.query.win_count }}勝</p>
    </div>
    <div v-else className="flex flex-col items-center w-[95vw] h-[43vh] border-red-600 border-[3px] rounded mt-[3vh] mb-[2vh] py-[3vw] px-[3vw] overflow-auto">
      <p className="text-red-600 mb-[20px] font-bold text-[3vh]">注意！</p>
      <p className="text-[2vh] text-center">{{ notice }}</p>
    </div>
    <router-link :to="{ name: 'user-score', params: { user_id: $route.params.user_id, game_id: $route.params.game_id }, query: { attacker_select_id: $route.query.attacker_select_id, win_count: win_count } }"
      className="bg-green-600 text-white font-bold py-[1vh] px-[20vw] text-[2vh] shadow-md hover:bg-green-700 duration-300">
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
      username: '',
      resultImage: '',
      win_count: parseInt(this.$route.query.win_count, 10) || 0
    };
  },
  methods: {
    async sendGameResult(defenderSelects, calculatedScore) {
      const attackerScore = 100 - calculatedScore;

      try {
        console.log('User ID:', this.$route.params.user_id);
        const userResponse = await axios.get(`http://localhost:8000/api/users/${this.$route.params.user_id}`);
        this.username = userResponse.data.username;
        console.log('User response:', userResponse.data);
        console.log('Username:', this.username);

        console.log('Opponent ID:', this.$route.query.opponent_id);
        const opponentResponse = await axios.get(`http://localhost:8000/api/users/${this.$route.query.opponent_id}`);
        this.attackername = opponentResponse.data.username;
        console.log('User response:', opponentResponse.data);
        console.log('Attackername:', this.attackername);
      
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
        this.resultImage = 'win';
        this.win_count += 1;
      } else if(this.score === 50){
        this.result = '引き分け';
      } else {
        this.resultImage = 'lose';
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
