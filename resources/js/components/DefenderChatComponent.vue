<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-blue-500 flex justify-center items-center">
      <h1 className="w-[100%] text-[3vh] font-bold ml-[40px] text-white">個人情報カード選択</h1>
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center pt-[1vh]">
    <ul class="flex flex-wrap gap-x-[1vh] justify-center items-center gap-y-[1vh] py-[1vh]">
      <li v-for="(card, index) in defenderCards" :key="card.id" :class="{ 'bg-blue-100': selectedCards.includes(index + 1) }">
        <button @click="selectCard(index + 1)" class="w-[46vw] h-[10vh] bg-blue-300 justify-start items-center px-[2vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[8vh] h-[8vh]">
          <p className="text-[2vh] font-bold pl-[1vw]">{{ card.defender_card_name }}</p>
        </button>
      </li>
    </ul>
    <div className="flex w-[100%] justify-center items-center text-[2vh]">
      <p className="text-blue-600 font-bold flex items-center justify-center mr-[8vw]">残り時間 : {{ timeLeft }}</p>
      <button 
        :disabled="selectedCards.length !== 3" 
        @click="confirmSelection" 
        class="text-white font-bold py-[6px] px-[6vw] my-[30px] mr-[10px] border-[3px] border-blue-500 hover:border-blue-600
        hover:bg-blue-600 bg-blue-500 duration-300 shadow-sm rounded"
        :class="{ 'opacity-50 cursor-not-allowed': selectedCards.length !== 3 }">
        カードを決定する
      </button>
    </div>
    <div class="border border-gray-300 bg-white p-3 rounded overflow-auto h-[45vh] w-[90vw] mb-4 text-[2vh]">
      <div v-for="message in conversation" :key="message.id" class="mb-3">
        <div v-if="message.role === 'assistant'" class="text-blue-500 font-bold">
          <span>対戦相手:</span> {{ message.content }}
        </div>
        <div v-else-if="message.role === 'user'" class="text-green-500 font-bold">
          <span>あなた:</span> {{ message.content }}
        </div>
      </div>
    </div>
    <form @submit.prevent="sendMessage" class="flex w-[90vw] text-[2vh]">
      <input v-model="userInput" placeholder="Type your message..." class="flex-grow p-2 border border-gray-300 rounded mr-2 pl-4"/>
      <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">送信</button>
    </form>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      defenderCards: [],
      userInput: '',
      conversation: [],
      username: '',
      userId: '',
      gameId: '',
      selectedCards: [],
      attacker_select_id: null,
      countdownTime: 5 * 60, // countdownTime in seconds (5 minutes)
      timeLeft: '05:00', // Displayed countdown timer
      showSubmit: false
    };
  },
  async created() {
    try {
      this.userId = this.$route.params.user_id;
      this.gameId = this.$route.params.game_id;

      const userResponse = await axios.get(`http://localhost:8000/api/users/${this.userId}`);
      this.username = userResponse.data.username;

      const response = await axios.get(`http://localhost:8000/api/game/${this.gameId}`);
      this.defenderCards = [
        response.data.defender_card1,
        response.data.defender_card2,
        response.data.defender_card3,
        response.data.defender_card4,
        response.data.defender_card5,
      ];
      this.startCountdown();
      this.attacker_select_id = Math.floor(Math.random() * 3) + 1;
    } catch (error) {
      console.error('Error fetching game information:', error);
    }
  },
  methods: {
    selectCard(cardNumber) {
      if (this.selectedCards.includes(cardNumber)) {
        this.selectedCards = this.selectedCards.filter(card => card !== cardNumber);
      } else if (this.selectedCards.length < 3) {
        this.selectedCards.push(cardNumber);
      }
    },
    confirmSelection() {
      this.$router.push({
        path: `/result/${this.userId}/${this.gameId}/`,
        query: {
          selectedCards: this.selectedCards,
          attacker_select_id: this.attacker_select_id,
        },
      });
    },
    listenForMessages() {
      const opponentId = this.$route.query.opponent_id;
      const userId = this.userId;

      // Listen to the user's own channel
      window.Echo.private('game.' + this.gameId + '.user.' + userId)
        .listen('.MessageSent', (e) => {
          if (e.message.sender_id === opponentId) {
            this.conversation.push({
              id: e.message.id,
              content: e.message.content,
              role: 'assistant' // Assuming 'assistant' means the opponent
            });
          }
        });

      // Listen to the opponent's channel
      window.Echo.private('game.' + this.gameId + '.user.' + opponentId)
        .listen('.MessageSent', (e) => {
          if (e.message.sender_id === userId) {
            this.conversation.push({
              id: e.message.id,
              content: e.message.content,
              role: 'user' // Assuming 'user' means the current user
            });
          }
        });
    },
    sendMessage() {
      const opponentId = this.$route.query.opponent_id;

      // Axios post to Laravel backend to send message
      axios.post('/api/messages', {
        message: this.userInput,
        gameId: this.gameId,
        receiver_id: opponentId,
        sender_id: this.userId
      }).then(response => {
        this.userInput = ''; // Clear the input after sending
      });
    },
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
  },
};
</script>
