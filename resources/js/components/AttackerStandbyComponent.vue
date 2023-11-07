<template>
  <div class="flex w-[100vw] h-[10vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-[#E76767] flex justify-center items-center">
      <h1 className="w-[100%] text-[4vh] font-bold ml-[40px] text-white">提供側カード選択</h1>
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[90vh]">
    <ul class="flex flex-col gap-x-5 justify-center items-center gap-y-[2vh] py-[3vh]">
      <li v-for="(card) in defenderCards" :key="card.id">
        <div class="w-[85vw] h-[15vh] bg-blue-300 justify-start items-center pl-[5vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[14vh] h-[14vh]">
          <p className="text-[3vh] font-bold pl-[5vw]">{{ card.defender_card_name }}</p>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        defenderCards: [],
        selectedCards: [],
      }
    },
    async created() {
    try {
      this.gameId = this.$route.params.game_id;
      const response = await axios.get(`http://localhost:8000/api/game/${this.gameId}`);
      this.defenderCards = [
        response.data.defender_card1,
        response.data.defender_card2,
        response.data.defender_card3,
        response.data.defender_card4,
        response.data.defender_card5,
      ];
    } catch (error) {
      console.error('Error fetching game information:', error);
    }
  },
  }
</script>
