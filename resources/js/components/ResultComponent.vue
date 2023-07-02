<template>
  <div className="flex flex-col items-center">
    <div className="flex justify-between items-center" id="result">
      <h1 className="desktop:text-[60px] sp:text-[26px] text-blue-600 mt-[100px] mb-[20px] desktop:text-left sp:text-center">
        結果: {{ result }}
      </h1>
    </div>
    <div className="flex desktop:flex-row sp:flex-col desktop:justify-between sp:justify-center gap-x-10 gap-y-5 desktop:mb-[50px] sp:mb-[60px]">
      <p className="desktop:text-left sp:text-center text-[24px] desktop:w-[350px] sp:w-[100%]">あなたの得点:{{ 100 - score }}</p>
      <p className="desktop:text-left sp:text-center text-[24px] desktop:w-[350px] sp:w-[100%]">相手の得点:{{ score }}</p>
    </div>
    <router-link :to="{ name: 'user-score', params: { id: $route.params.id, username: $route.params.username }, query: { attacker_select_id: $route.query.attacker_select_id } }"
      className="bg-blue-500 text-white font-bold py-[10px] px-[70px] shadow-md hover:bg-blue-600 duration-300">
      配点を見る
    </router-link>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "ResultComponent",
  data() {
    return {
      score: 0,
      result: ''
    };
  },
  mounted() {
    const gameId = this.$route.params.id;
    const selectedCards = this.$route.query.selectedCards;
    const attackerSelectId = this.$route.query.attacker_select_id;

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
    })
  },
};
</script>
