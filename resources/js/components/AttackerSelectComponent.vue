<template>
  <h1 className="desktop:text-[40px] sp:text-[20px]  desktop:my-[90px] sp:my-[20px]">個人情報利用側＜カード選択＞</h1>
  <div className="flex desktop:flex-row sp:flex-col gap-x-20 justify-center items-center gap-y-5">
    <button className="desktop:w-[250px] sp:w-[80%] desktop:h-[350px] sp:h-[120px] bg-red-300 hover:border-[5px] justify-center items-center
      hover:border-red-400 duration-500 desktop:text-[24px] sp:text-[20px] font-bold shadow-xl flex desktop:flex-col sp:flex-row" v-on:click='card1'>
      <!--{{ $store.state.attacker1 }}
      <img :src="imgAt1" className="sp:h-[90px] desktop:h-auto sp:pl-[10px] desktop:pl-0">-->
    </button>
    <button className="desktop:w-[250px] sp:w-[80%] desktop:h-[350px] sp:h-[120px] bg-red-300 hover:border-[5px] justify-center items-center
     hover:border-red-400 duration-500 desktop:text-[24px] sp:text-[20px] font-bold shadow-xl flex desktop:flex-col sp:flex-row" v-on:click='card2'>
      <!--<p>{{ $store.state.attacker2 }}</p>
      <img :src="imgAt2" className="sp:h-[90px] desktop:h-auto sp:pl-[10px] desktop:pl-0">-->
    </button>
    <button className="desktop:w-[250px] sp:w-[80%] desktop:h-[350px] sp:h-[120px] bg-red-300 hover:border-[5px] justify-center items-center
     hover:border-red-400 duration-500 desktop:text-[24px] sp:text-[20px] font-bold shadow-xl flex desktop:flex-col sp:flex-row" v-on:click='card3'>
      <!--<p>{{ $store.state.attacker3 }}</p>
      <img :src="imgAt3" className="sp:h-[90px] desktop:h-auto sp:pl-[10px] desktop:pl-0">-->
    </button>
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
