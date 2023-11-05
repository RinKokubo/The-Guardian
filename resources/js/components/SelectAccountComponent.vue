<template>
  <div>
    <div className="flex items-center flex-col">
      <h1 className="text-[30px] text-blue-600 desktop:mt-[80px] sp:my-[30px]">
        アカウントを選択してください
      </h1>
    </div>
    <div className="flex desktop:flex-row sp:flex-col desktop:justify-center sp:items-center desktop:flex-wrap">
      <button
        v-for="user in users" 
        :key="user.id" 
        class="text-[28px] w-[200px] desktop:mt-[40px] sp:mt-[10px] mx-[30px]
        hover:underline hover:underline-offset-4 duration-500"
        @click="login(user.id)"
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
        // ここでログイン処理を呼び出します
        await axios.post('/api/login-without-password', { user_id: user.id });
        // ログイン後のパラメータ付きでintroductionページにリダイレクト
        this.$router.push({ name: 'introduction', params: { user_id: user.id, game_id: 1 } });
      } catch (error) {
        console.error('Login failed:', error);
      }
    }
  },
  async created() {
    const response = await axios.get('/api/users')
    this.users = response.data
  },
})
</script>