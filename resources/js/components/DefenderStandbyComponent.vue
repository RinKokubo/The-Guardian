<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-blue-500 flex justify-center items-center">
      <h1 className="w-[100%] text-[3vh] font-bold ml-[40px] text-white">悪用カード選択</h1>
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div v-if="this.$route.query.talk == 'face'">
      <router-link :to="{ name: 'defender-select', params: { user_id: $route.params.user_id, game_id: $route.params.game_id }, query: { opponent_id: $route.query.opponent_id } }"
        className="bg-green-600 text-white font-bold py-[1vh] px-[20vw] text-[2vh] shadow-md hover:bg-green-700 duration-300">
        配点を見る
      </router-link>
    </div>
    <div v-else>

    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        userId: this.$route.params.user_id,
        selectedCard: null,
      };
    },
    mounted() {
      console.log(`Connecting to channel: user.${this.userId}`);
      ///Echo.private(`user.${this.userId}`)
      //  .listen('card.selected', (event) => {
      //    console.log('カードが選択されました:', event.card);
      //    this.selectedCard = event.card;
      //  });
    },
  }
</script>
