<template>
  <div>
    <div>
      <p>result: {{ score }}</p>
    </div>
    <router-link :to="{ name: 'user-score', params: { id: $route.params.id, username: $route.params.username }, query: { attacker_select_id: $route.query.attacker_select_id } }">
      next
    </router-link>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "ResultComponent",
  data() {
    return {
      score: 0,
    };
  },
  mounted() {
    const gameId = this.$route.params.id;
    const selectedCards = this.$route.query.selectedCards;
    const attackerSelectId = this.$route.query.attacker_select_id;
    axios.get(`/api/score/${gameId}`, {
      params: { selectedCards, attacker_select_id: attackerSelectId },
    })
    .then((response) => {
      this.score = response.data.score;
    });
  },
};
</script>
