<template>
  <div class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-4">Defender Cards</h1>
    <ul class="space-y-2 mb-8">
      <li v-for="card in defenderCards" :key="card.id" class="p-4 bg-blue-100 rounded">
        {{ card.defender_card_name }}
      </li>
    </ul>
    <div class="border border-gray-300 p-4 rounded overflow-auto h-64 mb-4">
      <div v-for="message in conversation" :key="message.id" class="mb-4">
        <div v-if="message.role === 'assistant'" class="text-blue-500 font-bold">
          <span>ChatGPT:</span> {{ message.content }}
        </div>
        <div v-else-if="message.role === 'user'" class="text-green-500 font-bold">
          <span>You:</span> {{ message.content }}
        </div>
      </div>
    </div>
    <form @submit.prevent="sendMessage" class="flex">
      <input v-model="userInput" placeholder="Type your message..." class="flex-grow p-2 border border-gray-300 rounded mr-2"/>
      <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Send</button>
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
      this.startConversation();  // Removed arguments
    } catch (error) {
      console.error('Error fetching game information:', error);
    }
  },
  methods: {
    startConversation() {
      axios.post(`http://localhost:8000/diffender-select-dialogue/${this.username}/${this.gameId}/start`) // Changed URL
        .then(response => {
          this.conversation = response.data;
        })
        .catch(error => {
          console.error('Error starting conversation:', error);
        });
    },
    sendMessage() {
      axios.post(`http://localhost:8000/diffender-select-dialogue/${this.username}/${this.gameId}/send-message`, { message: this.userInput }) // Changed URL
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
