<template>
  <div>
    <div v-for="card in defenderCards" :key="card.id">
      <img :src="card.image" @click="selectCard(card)" />
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      defenderCards: [],
      selectedCards: [],
    };
  },
  async mounted() {
    const id = this.$route.params.id;
    const response = await axios.get(`/api/game/${id}`);
    this.defenderCards = [
      response.data.defender_card1_id,
      response.data.defender_card2_id,
      response.data.defender_card3_id,
      response.data.defender_card4_id,
      response.data.defender_card5_id,
    ];
  },
  methods: {
    selectCard(card) {
      if (this.selectedCards.length < 3) {
        this.selectedCards.push(card);
      }
    },
  },
};
</script>

