<template>
  <div class="flex justify-center items-center w-[100vw] h-[100vh] text-center flex-col">
    <h2 class="text-[30px] text-blue-600 font-bold my-[60px]">個人情報保護ゲーム</h2>
    <p>{{ userRole }}</p>
    
    <!-- defenderの画面 -->
    <div v-if="userRole === 'defender'">
      <p class="text-[20px] my-[6px]">あなたは個人情報提供側として、個人情報利用側であるChatGPTと対戦します。</p>
      <p class="text-[20px] mt-[6px] mb-[150px]">５枚の個人情報カードが配られるので、個人情報利用側と対話し、相手に知られてもいいと思うカードを３枚選んでください。</p>
      
    </div>
    <p v-else-if="userRole === 'attacker'">userRole is attacker</p>
    <p v-else-if="userRole === null">userRole is null</p>
    <p v-else>userRole is something else</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "IntroComponent",
  data() {
    return {
      userRole: 'loading',
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
    } catch (error) {
      console.error('Error fetching match info:', error);
      this.userRole = null;
    }
  }
}
</script>
