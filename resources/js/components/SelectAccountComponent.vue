<template>
  <div class="h-[100vh] bg-[#E5E5E5]">
    <div className="flex items-center flex-col h-[8vh] bg-green-600 w-[100vw]">
      <h1 className="text-[3vh] text-white py-[2vh] font-bold">
        アカウントを選択してください
      </h1>
    </div>
    <div className="flex justify-center items-center flex-wrap mt-[3vh]">
      <button
        v-for="user in users" 
        :key="user.id" 
        class="text-[2.5vh] w-[40vw] mb-[2vh]
        hover:underline hover:underline-offset-4 duration-500"
        @click="login(user)"
      >
      {{ user.name }}
      </button>
    </div>
  </div>
</template>

<script lang="js">
import { defineComponent } from 'vue';
import axios from 'axios'

export default defineComponent({
  name: 'selectAccount',
  data() {
    return {
      users: [],
    }
  },
  methods: {
    async login(user) {
      try {
        console.log('Trying to login with user ID:', user.id);
        const response = await axios.post('/api/login-without-password', { user_id: user.id });
        console.log(response.data); // ここでログイン状態を確認
        this.$router.push({ name: 'introduction', params: { user_id: user.id, game_id: 1 },  query: { win_count: 0 } });
      } catch (error) {
        console.error('Login failed:', error.response ? error.response.data : error);
      }
    }
  },
  async created() {
    const response = await axios.get('/api/users')
    this.users = response.data
  },
})
</script>