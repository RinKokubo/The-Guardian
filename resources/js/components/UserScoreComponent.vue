<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-[#E76767] flex justify-center items-center">
      <h1 className="w-[100%] text-[3vh] font-bold ml-[40px] text-white">配点内訳</h1>
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center">
    <p class="text-[2vh] mx-[5vw] pt-[2vh]">もしあなたが利用者カード<span class="font-bold text-red-500">「{{ attackerCardName }}」</span>に対して、各提供カードに100点満点で点数をつけるとしたら？</p>
    <div class="flex">
      <div class="flex flex-col items-center gap-y-[2vh] pt-[3vh] pb-[3vh]">
        <div class="w-[60vw] h-[12vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${defenderCard1Name}.png`" alt="defender_card" class="w-[11vh] h-[11vh]">
          <p className="text-[2vh] font-bold pl-[2vw]">{{ defenderCard1Name }}</p>
        </div>
        <div class="w-[60vw] h-[12vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${defenderCard2Name}.png`" alt="defender_card" class="w-[11vh] h-[11vh]">
          <p className="text-[2vh] font-bold pl-[2vw]">{{ defenderCard2Name }}</p>
        </div>
        <div class="w-[60vw] h-[12vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${defenderCard3Name}.png`" alt="defender_card" class="w-[11vh] h-[11vh]">
          <p className="text-[2vh] font-bold pl-[2vw]">{{ defenderCard3Name }}</p>
        </div>
        <div class="w-[60vw] h-[12vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${defenderCard4Name}.png`" alt="defender_card" class="w-[11vh] h-[11vh]">
          <p className="text-[2vh] font-bold pl-[2vw]">{{ defenderCard4Name }}</p>
        </div>
        <div class="w-[60vw] h-[12vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${defenderCard5Name}.png`" alt="defender_card" class="w-[11vh] h-[11vh]">
          <p className="text-[2vh] font-bold pl-[2vw]">{{ defenderCard5Name }}</p>
        </div>
      </div>
      <div class="flex flex-col items-center text-[2vh] mx-[3vw] font-bold">
        <p class="text-[2vh]">配点</p>
        <div class="flex flex-col items-center gap-y-[2vh]">
          <p class="w-[10vw] h-[12vh] flex justify-center items-center">{{ scores?.defender_card1_score }}</p>
          <p class="w-[10vw] h-[12vh] flex justify-center items-center">{{ scores?.defender_card2_score }}</p>
          <p class="w-[10vw] h-[12vh] flex justify-center items-center">{{ scores?.defender_card3_score }}</p>
          <p class="w-[10vw] h-[12vh] flex justify-center items-center">{{ scores?.defender_card4_score }}</p>
          <p class="w-[10vw] h-[12vh] flex justify-center items-center">{{ scores?.defender_card5_score }}</p>
        </div>
      </div>
      <form class="flex flex-col items-center text-[2vh] my-0 py-0">
        <p class="font-bold">あなた</p>
        <div class="flex flex-col items-center gap-y-[2vh]">
          <div class="flex items-center w-[15vw] h-[12vh] justify-center">
            <label for="card1Score"></label>
            <select class="border border-blue-500" v-model="card1Score" id="card1Score">
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
          <div class="flex items-center w-[15vw] h-[12vh] justify-center">
            <label for="card2Score"></label>
            <select class="border border-blue-500" v-model="card2Score" id="card2Score">
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
          <div class="flex items-center w-[15vw] h-[12vh] justify-center">
            <label for="card3Score"></label>
            <select class="border border-blue-500" v-model="card3Score" id="card3Score">
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
          <div class="flex items-center w-[15vw] h-[12vh] justify-center">
            <label for="card4Score"></label>
            <select class="border border-blue-500" v-model="card4Score" id="card4Score">
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
          <div class="flex items-center w-[15vw] h-[12vh] justify-center">
            <label for="card5Score"></label>
            <select class="border border-blue-500" v-model="card5Score" id="card5Score">
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
    </div>
    <div v-if="parseInt($route.params.game_id) < 6" class="flex justify-end">
      <router-link :to="{ name: 'defender-select-dialogue', params: { user_id: $route.params.userId, game_id: parseInt($route.params.game_id) + 1 } }">
        <button class="text-white font-bold py-[6px] px-[20vw] border-[3px]  border-blue-500 hover:border-blue-600
                    hover:bg-blue-600 bg-blue-500 duration-300 shadow-xl text-[2vh]" @click="submitScores">
          もう一度対戦する
        </button>  
      </router-link>
    </div>
    <div v-else  class="flex justify-end">
      <router-link to="/">
        <button class="border-[3px] border-blue-500 text-blue-500 font-bold py-[6px] px-[20vw]
                   hover:bg-blue-500 hover:text-white duration-300 shadow-xl text-[2vh]" @click="submitScores">
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
