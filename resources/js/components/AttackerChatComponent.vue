<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-[#E76767] flex justify-center items-center">
      <h1 className="w-[100%] text-[3vh] font-bold ml-[40px] text-white">個人情報カード選択</h1>
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center pt-[1vh]">
    <ul class="flex flex-wrap gap-x-[1vh] justify-center items-center gap-y-[1vh] py-[1vh]">
      <li v-for="(card) in defenderCards" :key="card.id">
        <div class="w-[46vw] h-[10vh] bg-blue-300 justify-start items-center px-[2vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[8vh] h-[8vh]">
          <p className="text-[2vh] font-bold pl-[1vw]">{{ card.defender_card_name }}</p>
        </div>
      </li>
    </ul>
    <div className="flex w-[100%] justify-center items-center text-[2vh]">
      <p className="text-blue-600 font-bold flex items-center justify-center mr-[8vw]">残り時間 : {{ timeLeft }}</p>
    </div>
    <div class="border border-gray-300 bg-white p-3 rounded overflow-auto h-[45vh] w-[90vw] mb-4 text-[2vh]">
      <div v-for="message in conversation" :key="message.id" class="mb-3">
        <div v-if="message.sender === userId" class="text-green-500 font-bold">
          <span>あなた:</span> {{ message.content }}
        </div>
        <div v-else class="text-blue-500 font-bold">
          <span>対戦相手:</span> {{ message.content }}
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
      const cardInfoResponse = await axios.get(`/api/attacker-card-info/${this.$route.query.attacker_select}`);
      this.attacker_select_id = cardInfoResponse.data.id;
      Echo.private(`chat.${this.userId}`)
          .listen('.message.sent', (event) => {
              this.conversation.push({
                  sender: event.userId,
                  content: event.messageContent
              });
            console.log('イベントメッセージ',event.messageContent)
          });
    } catch (error) {
      console.error('Error fetching game information:', error);
    }
  },
  mounted() {
    Echo.private(`user.${this.$route.params.user_id}`)
      .listen('.defenderCards.selected', (event) => {
        console.log('カードが選択されました:', event.selectedCards);
        this.selectedCards = event.selectedCards;
        this.$router.push({
          path: `/result/${this.$route.params.user_id}/${this.$route.params.game_id}/`,
          query: {
            selectedCards: this.selectedCards,
            attacker_select_id: this.attacker_select_id,
            win_count: this.$route.query.win_count,
            role: 'attacker',
            opponent_id: this.$route.query.opponent_id,
          },
        });
      });
  },
  methods: {
    sendMessage() {
      const opponentId = this.$route.query.opponent_id;

      // メッセージを送信する前に、ローカルの会話に追加
      this.conversation.push({
        sender: this.userId,
        content: this.userInput
      });

      // メッセージをサーバーに送信
      axios.post('/api/messages', {
        message_content: this.userInput,
        game_id: this.gameId,
        receiver: opponentId,
        sender: this.userId,
        user_name: this.username
      }).then(response => {
        // 応答を受け取った後の処理（必要に応じて）
        this.userInput = ''; // 入力フィールドをクリア
      }).catch(error => {
        console.error(error.response.data);
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
