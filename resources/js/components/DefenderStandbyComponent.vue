<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-blue-500 flex justify-center items-center">
      <h1 className="w-[100%] text-[3vh] font-bold ml-[40px] text-white">悪用カード選択</h1>
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center">
    <div class="py-[4vh] flex flex-col items-center gap-y-5 text-[2vh]">
      <p>個人情報悪用側がカード選択中です。</p>
      <p>しばらくお待ちください。</p>
      <p v-if="selectedCard != null">
        {{ selectedCard }}
      </p>
    </div>
    <div class="w-[70vw] pt-[5vh]">
      <div v-if="this.$route.query.talk == 'face'">
        <router-link :to="{ name: 'defender-select', params: { user_id: $route.params.user_id, game_id: $route.params.game_id }, query: { opponent_id: $route.query.opponent_id, win_count: $route.query.win_count } }"
          class="flex justify-center items-center bg-blue-500 py-[1vh] px-[8vw] text-white font-bold text-[2.5vh]">
          個人情報カード選択へ進む
        </router-link>
      </div>
      <div v-else>
        <router-link :to="{ name: 'defender-select-chat', params: { user_id: $route.params.user_id, game_id: $route.params.game_id }, query: { opponent_id: $route.query.opponent_id, win_count: $route.query.win_count } }"
          class="flex justify-center items-center bg-blue-500 py-[1vh] px-[8vw] text-white font-bold text-[2.5vh]">
          個人情報カード選択へ進む
      </router-link>
      </div>
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
      Echo.private(`user.${this.userId}`)
        .listen('.card.selected', (event) => {
          console.log('カードが選択されました:', event.card);
          this.selectedCard = event.card;
        });
    },
  }
</script>
