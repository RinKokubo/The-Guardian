<template>
  <div>
    <h1>Defender Cards</h1>
    <ul>
      <li v-for="card in defenderCards" :key="card.id">
        {{ card.defender_card_name }}
      </li>
    </ul>
    <div>ChatGPTとの対話</div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      defenderCards: [],
    };
  },
  async created() {
  try {
    const gameId = this.$route.params.id;
    const response = await axios.get(`http://localhost:8000/api/game/${gameId}`); // TODO: パス変更
    this.defenderCards = [
      response.data.defender_card1,
      response.data.defender_card2,
      response.data.defender_card3,
      response.data.defender_card4,
      response.data.defender_card5,
    ];
    console.log(gameId);
  } catch (error) {
    console.error('Error fetching game information:', error);
  }
}
};
</script>
