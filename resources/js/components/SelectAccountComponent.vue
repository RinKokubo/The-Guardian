<template>
  <div>
  <div className="flex items-center flex-col">
    <h1 className="desktop:text-[30px] sp:text-[24px] text-blue-600 desktop:mt-[80px] sp:my-[30px]">
      アカウントを選択してください
    </h1>
  </div>
  <div className="flex desktop:flex-row sp:flex-col desktop:justify-center sp:items-center desktop:flex-wrap">
    <router-link to='/waiting-room'>
      <div v-for="user in users" :key="user.id" className="text-[24px] w-[200px] desktop:mt-[40px] sp:mt-[10px] mx-[30px]
      hover:underline hover:underline-offset-4 duration-500">
        {{ user.name }}
      </div>
    </router-link>
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
  }
})
</script>