<template>
  <div>
    <div className="flex items-center flex-col">
      <h1 className="desktop:text-[30px] sp:text-[24px] text-blue-600 desktop:mt-[80px] sp:my-[30px]">
        アカウントを選択してください
      </h1>
    </div>
    <div className="flex desktop:flex-row sp:flex-col desktop:justify-center sp:items-center desktop:flex-wrap">
        <div 
          v-for="user in users" 
          :key="user.id" 
          className="text-[24px] w-[200px] desktop:mt-[40px] sp:mt-[10px] mx-[30px]
          hover:underline hover:underline-offset-4 duration-500"
        >
          <router-link :to="{ name: 'introduction', params: { user_id: user.id } }">
            {{ user.name }}
          </router-link>
        </div>
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
  async created() {
    const response = await axios.get('/api/users')
    this.users = response.data
  },
  // methods: {
  //  handleUserClick(user) {
  //    const password = window.prompt(`${user.name} のパスワードを入力してください`)
  //    if (password) {
  //      // パスワードが入力されたら、それを使ってログイン処理を行う
  //      // この例では具体的なログイン処理は省略しています
  //      
  //    }
  //  }
  //}
})
</script>