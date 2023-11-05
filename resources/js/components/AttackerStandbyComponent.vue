<template>
  <div>
    <h1 class="desktop:text-[60px] sp:text-[30px] text-blue-600 mt-[120px] text-center text-shadow">個人情報保護ゲーム</h1>  
    <div class="flex justify-center my-[30px]">
      <ul class="flex flex-row gap-x-5 justify-center items-center">
        <li v-for="(card, index) in defenderCards" :key="card.id" :class="{ 'bg-blue-100': selectedCards.includes(index + 1) }">
          <div class="w-[200px] h-[280px] bg-blue-200 items-center justify-center
           duration-500 text-[24px] font-bold shadow-xl flex flex-col">
            <p>{{ card.defender_card_name }}</p>
            <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card">
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  export default {
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
