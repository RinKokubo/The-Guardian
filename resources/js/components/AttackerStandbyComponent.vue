<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-[#E76767] flex justify-center items-center">
      <h1 className="w-[100%] text-[3vh] font-bold ml-[40px] text-white">個人情報カード選択</h1>
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <p className="font-bold flex items-center justify-center text-[3vh] py-[2vh] text-red-500">残り時間 : {{ timeLeft }}</p>
    <ul class="flex flex-col gap-x-5 justify-center items-center gap-y-[2vh] pb-[3vh]">
      <li v-for="(card) in defenderCards" :key="card.id">
        <div class="w-[90vw] h-[14vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[12vh] h-[12vh]">
          <p className="text-[3vh] font-bold pl-[3vw]">{{ card.defender_card_name }}</p>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        defenderCards: [],
        selectedCards: [],
        countdownTime: 5 * 60, // countdownTime in seconds (5 minutes)
        timeLeft: '05:00', // Displayed countdown timer
      }
    },
    async created() {
      try {
        this.gameId = this.$route.params.game_id;
        const response = await axios.get(`http://localhost:8000/api/game/${this.gameId}`);
        this.defenderCards = [
          response.data.defender_card1,
          response.data.defender_card2,
          response.data.defender_card3,
          response.data.defender_card4,
          response.data.defender_card5,
        ];
        this.startCountdown();
        this.startConversation();
      } catch (error) {
        console.error('Error fetching game information:', error);
      }
    },
    methods: {
      startCountdown() {
        const timerInterval = setInterval(() => {
          if (this.countdownTime === 0) {
            clearInterval(timerInterval);
            // You may want to do something here when countdown reaches 0
          } else {
            this.countdownTime--;
            this.formatTimeLeft();
          }
        }, 1000);
      },
      formatTimeLeft() {
        const minutes = Math.floor(this.countdownTime / 60);
        const seconds = this.countdownTime % 60;
        this.timeLeft = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
      }
    }
  }
</script>
