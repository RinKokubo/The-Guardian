<template>
  <div class="mt-[20px]">
    <h1 class="desktop:text-[40px] sp:text-[22px] desktop:my-[50px] mx-[20px]
    sp:my-[20px] desktop:text-left sp:text-center">
      配点内訳<span class="text-red-500 text-[20px] font-bold desktop:pl-[30px]">個人情報利用側の選択：{{ attackerCardName }}</span>
    </h1>

    <div class="flex desktop:flex-row sp:flex-col gap-x-5 justify-center items-center sp:gap-y-5 mb-[15px]">
      <div class="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ defenderCard1Name }}</p>
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card1_score }}点</p>
        <img :src="`/img/${defenderCard1Name}.png`" alt="defender_card">
      </div>
      <div class="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ defenderCard2Name }}</p>
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card2_score }}点</p>
        <img :src="`/img/${defenderCard2Name}.png`" alt="defender_card">
      </div>
      <div class="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ defenderCard3Name }}</p>
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card3_score }}点</p>
        <img :src="`/img/${defenderCard3Name}.png`" alt="defender_card">
      </div>
      <div class="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ defenderCard4Name }}</p>
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card4_score }}点</p>
        <img :src="`/img/${defenderCard4Name}.png`" alt="defender_card">
      </div>
      <div class="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ defenderCard5Name }}</p>
        <p class="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card5_score }}点</p>
        <img :src="`/img/${defenderCard5Name}.png`" alt="defender_card">
      </div>
    </div>
    <p class="text-[22px] my-[40px] mx-[50px]">もしあなたが利用者カード「{{ attackerCardName }}」に対して、各提供カードに100点満点で点数をつけるとしたら？</p>
    <form>
      <div class="flex desktop:flex-row sp:flex-col gap-x-10 justify-center items-center sp:gap-y-5 mb-[15px]">
        <div class="flex items-center w-[200px] justify-center">
          <label for="card1Score"></label>
          <select class="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card1Score" id="card1Score">
            <option value="0">0</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
            <option value="60">60</option>
            <option value="65">65</option>
            <option value="70">70</option>
            <option value="75">75</option>
            <option value="80">80</option>
            <option value="85">85</option>
            <option value="90">90</option>
            <option value="95">95</option>
            <option value="100">100</option>
          </select> 
            点
        </div>
        <div class="flex items-center w-[200px] justify-center">
          <label for="card2Score"></label>
          <select class="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card2Score" id="card2Score">
            <option value="0">0</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
            <option value="60">60</option>
            <option value="65">65</option>
            <option value="70">70</option>
            <option value="75">75</option>
            <option value="80">80</option>
            <option value="85">85</option>
            <option value="90">90</option>
            <option value="95">95</option>
            <option value="100">100</option>
          </select> 
            点
        </div>
        <div class="flex items-center w-[200px] justify-center">
          <label for="card3Score"></label>
          <select class="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card3Score" id="card3Score">
            <option value="0">0</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
            <option value="60">60</option>
            <option value="65">65</option>
            <option value="70">70</option>
            <option value="75">75</option>
            <option value="80">80</option>
            <option value="85">85</option>
            <option value="90">90</option>
            <option value="95">95</option>
            <option value="100">100</option>
          </select> 
            点
        </div>
        <div class="flex items-center w-[200px] justify-center">
          <label for="card4Score"></label>
          <select class="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card4Score" id="card4Score">
            <option value="0">0</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
            <option value="60">60</option>
            <option value="65">65</option>
            <option value="70">70</option>
            <option value="75">75</option>
            <option value="80">80</option>
            <option value="85">85</option>
            <option value="90">90</option>
            <option value="95">95</option>
            <option value="100">100</option>
          </select> 
            点
        </div>
        <div class="flex items-center w-[200px] justify-center">
          <label for="card5Score"></label>
          <select class="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card5Score" id="card5Score">
            <option value="0">0</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="35">35</option>
            <option value="40">40</option>
            <option value="45">45</option>
            <option value="50">50</option>
            <option value="55">55</option>
            <option value="60">60</option>
            <option value="65">65</option>
            <option value="70">70</option>
            <option value="75">75</option>
            <option value="80">80</option>
            <option value="85">85</option>
            <option value="90">90</option>
            <option value="95">95</option>
            <option value="100">100</option>
          </select> 
            点
        </div>
      </div>
    </form>
    <div v-if="parseInt($route.params.game_id) < 6" class="flex justify-end">
      <router-link :to="{ name: 'defender-select-dialogue', params: { userId: $route.params.userId, id: parseInt($route.params.game_id) + 1 } }">
        <button class="text-white font-bold py-[6px] px-[10px] mt-[30px] mr-[80px] border-[3px]  border-blue-500 hover:border-blue-600
                    hover:bg-blue-600 bg-blue-500 duration-300 shadow-sm" @click="submitScores">
          もう一度対戦する
        </button>  
      </router-link>
    </div>
    <div v-else  class="flex justify-end">
      <router-link to="/">
        <button class="border-[3px] border-blue-500 text-blue-500 font-bold py-[6px] px-[10px] mt-[30px] mr-[80px]
                   hover:bg-blue-500 hover:text-white duration-300 shadow-sm" @click="submitScores">
          ゲームを終了する
        </button>
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      scores: {},
      gameInformation: null,
      defenderCardNames: {},
      attackerCardName: '',
      username: '',
      card1Score: null,
      card2Score: null,
      card3Score: null,
      card4Score: null,
      card5Score: null,
      defenderCard1Name: null,
      defenderCard2Name: null,
      defenderCard3Name: null,
      defenderCard4Name: null,
      defenderCard5Name: null,
      gameIdforPath: this.$route.params.game_id
    };
  },
  created() {
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

    axios.get(`/api/getScore/${gameId}?attacker_select_id=${attackerSelectId}`)
      .then(response => {
        this.scores = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  },
  methods: {
    submitScores() {
      const gameId = this.$route.params.id;
      const attackerSelectId = this.$route.query.attacker_select_id;
      const userResponse = axios.get(`http://localhost:8000/api/users/${this.$route.params.userId}`);
      const username = userResponse.data.username;

      axios.post(`/api/user_scores`, {
        game_id: gameId,
        attacker_select_id: attackerSelectId,
        user_name: username,
        user_card1_score: this.card1Score,
        user_card2_score: this.card2Score,
        user_card3_score: this.card3Score,
        user_card4_score: this.card4Score,
        user_card5_score: this.card5Score,
      })
      .then(response => {
        console.log(response);
      })
      .catch(error => {
        console.error(error);
      });
    },
  },
};
</script>
