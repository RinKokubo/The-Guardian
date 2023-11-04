<template>
  <h1 className="desktop:text-[40px] sp:text-[20px]  desktop:my-[90px] sp:my-[20px]">個人情報利用側＜カード選択＞</h1>
  <div className="flex desktop:flex-row sp:flex-col gap-x-20 justify-center items-center gap-y-5">
    <button className="desktop:w-[250px] sp:w-[80%] desktop:h-[350px] sp:h-[120px] bg-red-300 hover:border-[5px] justify-center items-center
      hover:border-red-400 duration-500 desktop:text-[24px] sp:text-[20px] font-bold shadow-xl flex desktop:flex-col sp:flex-row" v-on:click="attackerSelectCard('card1')">
      <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ attackerCard1Name }}</p>
      <img :src="`/img/${attackerCard1Name}.png`" alt="defender_card">
    </button>
    <button className="desktop:w-[250px] sp:w-[80%] desktop:h-[350px] sp:h-[120px] bg-red-300 hover:border-[5px] justify-center items-center
     hover:border-red-400 duration-500 desktop:text-[24px] sp:text-[20px] font-bold shadow-xl flex desktop:flex-col sp:flex-row" v-on:click="attackerSelectCard('card2')">
      <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ attackerCard2Name }}</p>
      <img :src="`/img/${attackerCard2Name}.png`" alt="defender_card">
    </button>
    <button className="desktop:w-[250px] sp:w-[80%] desktop:h-[350px] sp:h-[120px] bg-red-300 hover:border-[5px] justify-center items-center
     hover:border-red-400 duration-500 desktop:text-[24px] sp:text-[20px] font-bold shadow-xl flex desktop:flex-col sp:flex-row" v-on:click="attackerSelectCard('card3')">
      <p className="desktop:text-[20px] sp:text-[16px] sp:pr-[10px] desktop:pr-0">{{ attackerCard3Name }}</p>
      <img :src="`/img/${attackerCard3Name}.png`" alt="defender_card">
    </button>
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

        axios.post('/api/attacker-select-card', { cardName, opponentId })
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
