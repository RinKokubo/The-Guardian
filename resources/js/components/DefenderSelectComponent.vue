<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-blue-500 flex justify-center items-center">
      <h1 class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">個人情報カード選択</h1>
      <button @click="menuVisible = !menuVisible" class="text-white font-semibold text-[2.5vh] w-[3.5vh] h-[3.5vh] border-[3px] border-white rounded-full flex justify-center items-center mr-[5vw]">？</button>
      <MenuComponent v-model:modelValue="menuVisible" />
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div class=" flex items-center justify-center text-[2.5vh]">
      <p className="text-blue-600 font-bold mr-[8vw]">残り時間 : {{ timeLeft }}</p>
      <button 
        :disabled="selectedCards.length !== 3" 
        @click="confirmSelection" 
        class="text-white font-bold py-[6px] px-[6vw] my-[2vh] border-[3px] border-blue-500 hover:border-blue-600
        hover:bg-blue-600 bg-blue-500 duration-300 shadow-sm rounded"
        :class="{ 'opacity-50 cursor-not-allowed': selectedCards.length !== 3 }">
        カードを決定する
      </button>
    </div>
    <ul class="flex flex-col gap-x-5 justify-center items-center gap-y-[2vh] pb-[3vh]">
      <li v-for="(card, index) in defenderCards" :key="card.id" :class="{ 'selected-border': selectedCards.includes(index + 1) }">
        <button @click="selectCard(index + 1)" class="w-[90vw] h-[14vh] bg-blue-300 justify-start items-center px-[3vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[12vh] h-[12vh]">
          <p className="text-[3vh] font-bold pl-[3vw]">{{ card.defender_card_name }}</p>
        </button>
      </li>
    </ul>
  </div>
</template>

<script>
import MenuComponent from './MenuComponent.vue';

export default {
  components: {
    MenuComponent
  },
    data() {
      return {
        defenderCards: [],
        selectedCards: [],
        countdownTime: 5 * 60, // countdownTime in seconds (5 minutes)
        timeLeft: '05:00', // Displayed countdown timer
        menuVisible: false,
      }
    },
    async created() {
      try {
        this.gameId = this.$route.params.game_id;
        const response = await axios.get(`http://localhost:8000/api/game/${this.gameId}`);
        // const response = await axios.get(`https://rma.iiojun.com/api/game/${this.gameId}`);
        this.defenderCards = [
          response.data.defender_card1,
          response.data.defender_card2,
          response.data.defender_card3,
          response.data.defender_card4,
          response.data.defender_card5,
        ];
        this.startCountdown();
        const cardInfoResponse = await axios.get(`/api/attacker-card-info/${this.gameId}/${decodeURIComponent(this.$route.query.selected_card)}`);
        this.attacker_select_id = cardInfoResponse.data.attackerCardNumber;
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
      },
      selectCard(cardNumber) {
      if (this.selectedCards.includes(cardNumber)) {
        this.selectedCards = this.selectedCards.filter(card => card !== cardNumber);
      } else if (this.selectedCards.length < 3) {
        this.selectedCards.push(cardNumber);
      }
    },
    confirmSelection() {
      if (this.selectedCards.length === 3) {
        axios.post('/api/defender-select-card', {
          user_id: this.$route.params.user_id,
          opponent_id: this.$route.query.opponent_id,
          selected_cards: this.selectedCards
        }).then(() => {
          this.$router.push({
            path: `/result/${this.$route.params.user_id}/${this.$route.params.game_id}/`,
            query: {
              selectedCards: this.selectedCards,
              win_count: this.$route.query.win_count,
              role: 'defender',
              attacker_select_id: this.attacker_select_id,
              opponent_id: this.$route.query.opponent_id
            },
          });
        }).catch(error => {
          console.error('カード情報の送信に失敗しました', error);
        });
      } else {
        console.error('3枚のカードが選択されていません');
      }
    },
    }
  }
</script>

<style>
.selected-border {
  border: 3px solid #3b82f6;
}
</style>