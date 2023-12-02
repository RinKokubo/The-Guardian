<template>
  <div class="w-[100vw] h-[100vh] bg-[#E5E5E5] flex flex-col justify-center items-center">
    <h1 class="text-[10vw] text-green-600 mt-[12vh] font-bold text-center drop-shadow-2xl">THE GUARDIAN</h1>  
    <div class="flex justify-center my-[8vh]">
      <img src='/img/privacy.png' class="sp:w-[75vw] desktop:w-[30vh]">
    </div>
    <button @click="start" class="bg-green-600 text-white hover:bg-green-700 sp:text-[8vw] desktop:text-[5vh] font-bold
                    text-center flex justify-center py-[2vh] shadow-2xl mb-[15vh] w-[100vw]">
    GAME START
    </button>
  </div>
</template>

<script>
  export default {
    name: "HelloComponent",
    methods: {
      start(){
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
        this.$router.push({  path: `/select-account` });
      }
    }
  }
</script>
