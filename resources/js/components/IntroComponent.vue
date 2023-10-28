<template>
  <div class="flex justify-center items-center w-[100vw] h-[100vh] text-center flex-col">
    <h2 class="text-[30px] text-blue-600 font-bold my-[60px]">個人情報保護ゲーム</h2>
    <p>{{ userRole }} {{ opponentId }}</p>
    
    <div v-if="opponentId === 31">
      <router-link :to="{ name: 'defender-select-dialogue', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId } }">
        ChatGPTとの対戦へ進む
      </router-link>
    </div>
    <div v-else-if="userRole === 'attacker'">
      <router-link :to="{ name: 'attacker-select', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId } }">
        attackerへ進む
      </router-link>
    </div>
    <div v-else-if="userRole === 'defender'">
      <router-link :to="{ name: 'introduction', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId } }">
        defenderへ進む
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "IntroComponent",
  data() {
    return {
      userRole: null,
      opponentId: null,
      user_id: null,
      game_id: null,
    }
  },
  async mounted() {
    try {
      const response = await axios.get('/api/match-info', {
        params: {
          user_id: this.$route.params.user_id,
          game_id: this.$route.params.game_id,
        }
      });
      this.userRole = response.data.user_role;
      this.opponentId = response.data.opponent_id;
      this.user_id = this.$route.params.user_id;
      this.game_id = this.$route.params.game_id;
    } catch (error) {
      console.error('Error fetching match info:', error);
      this.userRole = null;
    }
  }
}
</script>
