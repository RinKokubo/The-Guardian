<template>
  <div>
    <h1 class="desktop:text-[60px] sp:text-[30px] text-blue-600 mt-[120px] text-center text-shadow">個人情報保護ゲーム</h1>  
    <div class="flex justify-center my-[30px]">
    </div>
    <!--<div v-if="selectedCard">
      <p>カード「{{ selectedCard }}」が選択されました</p>
    </div>-->
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
