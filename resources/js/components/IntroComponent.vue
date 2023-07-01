<template>
  <div class="flex justify-center items-center w-[100vw] h-[100vh] text-center flex-col">
    <h2 class="text-[30px] text-blue-600 font-bold my-[60px]">個人情報保護ゲーム</h2>
    <p class="text-[20px] my-[6px]">あなたは個人情報提供側として、個人情報利用側であるChatGPTと対戦します。</p>
    <p class="text-[20px] mt-[6px] mb-[150px]">５枚の野個人情報カードが配られるので、個人情報利用側と対話し、相手に知られてもいいと思うカードを３枚選んでください。</p>
    <router-link :to="{ name: 'defender-select-dialogue', params: { id: 1, username: $route.params.username } }"
     class="bg-blue-500 text-white hover:bg-blue-600 text-[30px]
            text-center flex justify-center mx-[-150px] py-[3px] shadow-md w-[100vw]">
    GAME START
    </router-link>
  </div>
</template>

<script>
  export default {
    name: "IntroComponent",
  }
</script>
