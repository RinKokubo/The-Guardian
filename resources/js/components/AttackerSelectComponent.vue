<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-[#E76767] flex justify-center items-center">
      <h1 className="w-[100%] text-[3vh] font-bold ml-[40px] text-white">悪用カード選択</h1>
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div className="flex flex-col justify-center items-center gap-y-[4vh] py-[6vh]">
      <button className="w-[90vw] h-[20vh] bg-red-300 hover:border-[5px] justify-start items-center px-[3vw]
        hover:border-red-400 duration-500 shadow-2xl flex" v-on:click="attackerSelectCard('card1')">
        <img :src="`/img/${attackerCard1Name}.png`" alt="attacker_card" class="w-[16vh] h-[16vh]">
        <p className="text-[3vh] font-bold pl-[5vw]">{{ attackerCard1Name }}</p>
      </button>
      <button className="w-[90vw] h-[20vh] bg-red-300 hover:border-[5px] justify-start items-center px-[3vw]
        hover:border-red-400 duration-500 shadow-2xl flex" v-on:click="attackerSelectCard('card2')">
        <img :src="`/img/${attackerCard2Name}.png`" alt="attacker_card" class="w-[16vh] h-[16vh]">
        <p className="text-[3vh] font-bold pl-[5vw]">{{ attackerCard2Name }}</p>
      </button>
      <button className="w-[90vw] h-[20vh] bg-red-300 hover:border-[5px] justify-start items-center px-[3vw]
        hover:border-red-400 duration-500 shadow-2xl flex" v-on:click="attackerSelectCard('card3')">
        <img :src="`/img/${attackerCard3Name}.png`" alt="attacker_card" class="w-[16vh] h-[16vh]">
        <p className="text-[3vh] font-bold pl-[5vw]">{{ attackerCard3Name }}</p>
      </button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

  export default {
    data() {
      return {
        gameInformation: null,
        attackerCard1Name: null,
        attackerCard2Name: null,
        attackerCard3Name: null,
      }
    },
    created() {
      axios.get(`/api/game/${this.$route.params.game_id}`)
        .then(response => {
            this.gameInformation = response.data;
            this.attackerCard1Name = this.gameInformation.attacker_card1.attacker_card_name;
            this.attackerCard2Name = this.gameInformation.attacker_card2.attacker_card_name;
            this.attackerCard3Name = this.gameInformation.attacker_card3.attacker_card_name;
        })
        .catch(error => {
          console.error(error);
      });
    },
    methods: {
      attackerSelectCard(selectedCard) {
        const userId = this.$route.params.user_id;
        const gameId = this.$route.params.game_id;
        const opponentId = this.$route.query.opponent_id;
        const cardName = this[selectedCard + 'Name'];

        axios.post('/api/attacker-select-card', { userId, cardName, opponentId })
          .then(response => {
            console.log('カード情報を送信しました');
            this.$router.push({
              path: `/attacker-standby/${userId}/${gameId}`,
              query: {
                opponent_id: opponentId,
                attacker_select: cardName,
              }
            });
          })
          .catch(error => {
            console.error('エラーが発生しました', error);
          });
      }
    }
  }
</script>
