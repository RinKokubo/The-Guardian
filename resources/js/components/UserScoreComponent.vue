<template>
  <div>
    <h1 className="desktop:text-[40px] sp:text-[22px] desktop:my-[50px]
    sp:my-[20px] desktop:text-left sp:text-center">
      配点内訳<span className="text-red-500 text-[20px] font-bold desktop:pl-[30px]">個人情報利用側の選択：</span>
    </h1>

    <div className="flex desktop:flex-row sp:flex-col gap-x-5 justify-center items-center sp:gap-y-5 mb-[15px]">
      <div className="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card1_score }}</p>
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">点</p>
      </div>
      <div className="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card2_score }}</p>
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">点</p>
      </div>
      <div className="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card3_score }}</p>
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">点</p>
      </div>
      <div className="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card4_score }}</p>
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">点</p>
      </div>
      <div className="desktop:w-[200px] sp:w-[80%] desktop:h-[300px] sp:h-[80px] bg-blue-200 justify-center items-center font-bold shadow-xl flex desktop:flex-col sp:flex-row">
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ scores?.defender_card5_score }}</p>
        <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">点</p>
      </div>
    </div>
    <p className="text-[22px] my-[40px]">もしあなたが利用者カード「」に対して、各提供カードに100点満点で点数をつけるとしたら？</p>
    <form>
      <div className="flex desktop:flex-row sp:flex-col gap-x-10 justify-center items-center sp:gap-y-5 mb-[15px]">
        <div className="flex items-center w-[200px] justify-center">
          <label for="card1Score"></label>
          <select className="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card1Score" id="card1Score">
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
        <div className="flex items-center w-[200px] justify-center">
          <label for="card2Score"></label>
          <select className="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card2Score" id="card2Score">
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
        <div className="flex items-center w-[200px] justify-center">
          <label for="card3Score"></label>
          <select className="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card3Score" id="card3Score">
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
        <div className="flex items-center w-[200px] justify-center">
          <label for="card4Score"></label>
          <select className="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card4Score" id="card4Score">
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
        <div className="flex items-center w-[200px] justify-center">
          <label for="card5Score"></label>
          <select className="border border-blue-500 w-[100px] mr-[5px] pl-[10px]" v-model="card5Score" id="card5Score">
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
    <div className="flex justify-end">
      <router-link to="/" className="border-[3px] border-blue-500 text-blue-500 font-bold py-[6px] px-[10px] mt-[30px] mr-[10px]
                        hover:bg-blue-500 hover:text-white duration-300 shadow-sm">
        もう一度同じ相手と対戦する
      </router-link>
      <router-link to="/">
        <button className="text-white font-bold py-[6px] px-[10px] mt-[30px] mr-[10px] border-[3px]  border-blue-500 hover:border-blue-600
                          hover:bg-blue-600 bg-blue-500 duration-300 shadow-sm" v-on:click="resetSession">
          ゲームを終了する
        </button>
      </router-link>
    </div>  
  </div> 
</template>

<script>
import axios from 'axios';

export default {
  name: "UserScore",
  data() {
    return {
      scores: null,
    };
  },
  created() {
    const gameId = this.$route.params.id;
    const attackerSelectId = this.$route.query.attacker_select_id;

    // Replace with the actual URL of your API endpoint
    axios.get(`/api/getScore/${gameId}?attacker_select_id=${attackerSelectId}`)
      .then(response => {
        this.scores = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }
}
</script>
