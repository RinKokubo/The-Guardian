<template>
  <div>
    <h1>Defender Cards</h1>
    <ul>
      <li v-for="card in defenderCards" :key="card.id">
        {{ card.defender_card_name }}
      </li>
    </ul>
    <div>ChatGPTとの対話</div>
    <div v-for="message in conversation" :key="message.id">
      <strong>{{ message.role }}:</strong> {{ message.content }}
    </div>
    <input v-model="userInput" placeholder="Type your message..." />
    <button @click="sendMessage">Send</button>
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
    };
  },
  async created() {
    try {
      const gameId = this.$route.params.id;
      const response = await axios.get(`http://localhost:8000/api/game/${gameId}`);
      this.defenderCards = [
        response.data.defender_card1,
        response.data.defender_card2,
        response.data.defender_card3,
        response.data.defender_card4,
        response.data.defender_card5,
      ];
      this.startConversation();
    } catch (error) {
      console.error('Error fetching game information:', error);
    }
  },
  methods: {
    startConversation() {
      axios.get('http://localhost:8000/api/conversation/start')  // Laravel endpoint for starting the conversation
        .then(response => {
          this.conversation = response.data;
        })
        .catch(error => {
          console.error('Error starting conversation:', error);
        });
    },
    sendMessage() {
      axios.post('http://localhost:8000/api/conversation/message', { message: this.userInput })  // Laravel endpoint for sending a message
        .then(response => {
          this.conversation.push(response.data);
          this.userInput = '';
        })
        .catch(error => {
          console.error('Error sending message:', error);
        });
    },
  },
};
</script>
