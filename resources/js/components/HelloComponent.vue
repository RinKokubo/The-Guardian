<template>
  <div class="w-[100vw] h-[100vh]">
    <h1 class="desktop:text-[60px] sp:text-[30px] text-blue-600  desktop:mt-[120px] sp:mt-[30%] text-center text-shadow">個人情報保護ゲーム</h1>  
    <div class="flex justify-center my-[30px]">
      <img src='/img/privacy.png' width="250" alt="key-visual">
    </div>
    <router-link to="/select-account" class="bg-blue-500 text-white hover:bg-blue-600 text-[30px]
                    text-center flex justify-center mx-[-150px] py-[3px] shadow-md">
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
