<template>
  <div>
    <h1 class="desktop:text-[60px] sp:text-[30px] text-blue-600 mt-[120px] text-center text-shadow">個人情報保護ゲーム</h1>  
    <div class="flex justify-center my-[30px]">
    </div>
    <router-link to="/defender-select" class="bg-blue-500 text-white hover:bg-blue-600 text-[30px]
                    text-center flex justify-center mx-[-150px] py-[3px] shadow-md">
    待機画面
    </router-link>
  </div>
</template>

<script>
  export default {
    name: "HelloComponent",
    mounted() {
      console.log('Component mounted.')
    }
  }
</script>
