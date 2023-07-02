<template>
  <div class="max-w-2xl mx-auto px-4 py-10">
    <ul class="flex flex-row gap-x-5 justify-center items-center">
      <li v-for="(card, index) in defenderCards" :key="card.id" :class="{ 'bg-blue-100': selectedCards.includes(index + 1) }">
        <button @click="selectCard(index + 1)" class="w-[200px] h-[280px] bg-blue-200 hover:border-[5px] items-center justify-center
        hover:border-blue-400 duration-500 text-[24px] font-bold shadow-xl flex flex-col">
          <p>{{ card.defender_card_name }}</p>
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card">
        </button>
      </li>
    </ul>
    <button :disabled="selectedCards.length !== 3" @click="confirmSelection" class="text-white font-bold py-[6px] px-[10px] my-[30px] mr-[10px] border-[3px]  border-blue-500 hover:border-blue-600
    hover:bg-blue-600 bg-blue-500 duration-300 shadow-sm rounded">カードを決定</button>
    <div class="border border-gray-300 p-4 rounded overflow-auto h-64 mb-4">
      <div v-for="message in conversation" :key="message.id" class="mb-4">
        <div v-if="message.role === 'assistant'" class="text-blue-500 font-bold">
          <span>ChatGPT:</span> {{ message.content }}
        </div>
        <div v-else-if="message.role === 'user'" class="text-green-500 font-bold">
          <span>あなた:</span> {{ message.content }}
        </div>
      </div>
    </div>
    <form @submit.prevent="sendMessage" class="flex">
      <input v-model="userInput" placeholder="Type your message..." class="flex-grow p-2 border border-gray-300 rounded mr-2"/>
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
      gameId: '',
      selectedCards: [],
      attacker_select_id: null,
    };
  },
  async created() {
    try {
      this.username = this.$route.params.username; // Retrieve username from route
      this.gameId = this.$route.params.id;
      const response = await axios.get(`http://localhost:8000/api/game/${this.gameId}`);
      this.defenderCards = [
        response.data.defender_card1,
        response.data.defender_card2,
        response.data.defender_card3,
        response.data.defender_card4,
        response.data.defender_card5,
      ];
      this.startConversation();
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
        path: `/result/${this.username}/${this.gameId}/`,
        query: {
          selectedCards: this.selectedCards,
          attacker_select_id: this.attacker_select_id,
        },
      });
    },
    startConversation() {
      axios.post(`http://localhost:8000/defender-select-dialogue/${this.username}/${this.gameId}/start`) // Changed URL
        .then(response => {
          this.conversation = response.data;
        })
        .catch(error => {
          console.error('Error starting conversation:', error);
        });
    },
    sendMessage() {
      axios.post(`http://localhost:8000/defender-select-dialogue/${this.username}/${this.gameId}/send-message`, { message: this.userInput }) // Changed URL
        .then(response => {
          this.conversation.push({ role: 'user', content: this.userInput });
          this.conversation.push({ role: 'assistant', content: response.data.message });
          this.userInput = '';
        })
        .catch(error => {
          console.error('Error sending message:', error);
        });
    },
  },
};
</script>

<style>
.bg-blue-100 {
  /* Add your CSS to visually differentiate the selected cards */
  border: 2px solid #000;
}
</style>
