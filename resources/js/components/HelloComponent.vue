<template>
  <div class="w-[100vw] h-[100vh] bg-[#E5E5E5] flex flex-col justify-center items-center">
    <h1 class="text-[10vw] text-green-600 mt-[12vh] font-bold text-center drop-shadow-2xl">個人情報保護ゲーム</h1>  
    <div class="flex justify-center my-[8vh]">
      <img src='/img/privacy.png' class="sp:w-[75vw] desktop:w-[30vh]">
    </div>
    <router-link to="/select-account" class="bg-green-600 text-white hover:bg-green-600 sp:text-[8vw] desktop:text-[5vh] font-bold
                    text-center flex justify-center py-[2vh] shadow-2xl mb-[15vh] w-[100vw]">
    GAME START
    </router-link>
  </div>
</template>

<script>
  export default {
    name: "HelloComponent",
    mounted() {
      console.log('Component mounted.')
    },
    created() {
      axios.get(`/api/game/1`)
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
  }
</script>
