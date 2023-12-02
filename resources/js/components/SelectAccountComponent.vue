<template>
  <div class="h-[100vh] bg-[#E5E5E5]">
    <div className="flex items-center flex-col h-[8vh] bg-green-600 w-[100vw]">
      <h1 v-if="$i18n.locale === 'ja'" className="text-[3vh] text-white py-[2vh] font-bold">アカウントを選択してください</h1>
      <h1 v-else className="text-[3vh] text-white py-[2vh] font-bold">Select your account.</h1>
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

<script>
import { defineComponent } from 'vue';
import axios from 'axios'
import Echo from 'laravel-echo';

export default defineComponent({
  name: 'selectAccount',
  data() {
    return {
      users: [],
      password: ''
    }
  },
  methods: {
    async login(user) {
      try {
        const password = prompt('パスワードを入力してください');
        if (password) {
          try {
            // パスワードを含むリクエストを送信
            const response = await axios.post('/api/login', {
              user_id: user.id,
              password: password
            });

            // トークンがあればlocalStorageに保存し、axiosのデフォルトヘッダーに設定
            if (response.data.isLoggedIn && response.data.token) {
              localStorage.setItem('token', response.data.token);
              axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
              this.updateEchoInstance(response.data.token);
            } else {

            }
            this.$router.push({ name: 'introduction', params: { user_id: user.id, game_id: 1 }, query: { win_count: 0 } });
          } catch (error) {
            if (error.response && error.response.data.message) {
              alert(error.response.data.message);
            } else {
              console.error('Login failed:', error);
            }
          }
        } else {
          // パスワードが入力されなかった場合の処理
          alert('パスワードが必要です');
        }
      } catch (error) {
        console.error('Login failed:', error.response ? error.response.data : error);
      }
    },
    updateEchoInstance(newToken) {
      if (window.Echo) {
        window.Echo.disconnect();
      }
      window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        encrypted: true,
        wsHost: window.location.hostname,
        wsPort: 6001,
        disableStats: true,
        withCredentials: true,
        auth: {
          headers: {
            Authorization: `Bearer ${newToken}`,
          },
        },
      });
    }
  },
  async created() {
    const response = await axios.get('/api/users')
    this.users = response.data
  },
})
</script>