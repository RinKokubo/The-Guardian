<template>
  <!-- ヘッダ -->
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-blue-500 flex justify-center items-center">
      <h1 v-if="$i18n.locale === 'ja'" class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">個人情報カード選択</h1>
      <h1 v-else class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">Select 個人情報カード</h1>
      <button @click="menuVisible = !menuVisible" class="text-white font-semibold text-[2.5vh] w-[3.5vh] h-[3.5vh] border-[3px] border-white rounded-full flex justify-center items-center mr-[5vw]">？</button>
      <MenuComponent
        v-model:modelValue="menuVisible"
        :gameId="parseInt($route.params.game_id)"
        :userId="parseInt($route.params.user_id)"
        :role="'defender'"
      />
    </div>
  </div>

  <!-- 日本語版 -->
  <div v-if="$i18n.locale === 'ja'" class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center pt-[1vh]">
    <ul class="flex flex-wrap gap-x-[1vh] justify-center items-center gap-y-[1vh] py-[1vh]">
      <li v-for="(card, index) in defenderCards" :key="card.id" class="border-[2px] border-blue-300 solid" :class="{ 'selected-border': selectedCards.includes(index + 1) }">
        <button @click="selectCard(index + 1)" class="w-[46vw] h-[10vh] bg-blue-300 justify-start items-center px-[2vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[8vh] h-[8vh]">
          <p className="text-[2vh] font-bold pl-[1vw]">{{ card.defender_card_name }}</p>
        </button>
      </li>
    </ul>
    <div className="flex w-[95%] justify-center items-center text-[2vh]">
      <p className="text-blue-600 font-bold flex items-center justify-center mr-[6vw]">残り時間 : {{ timeLeft }}</p>
      <button 
        :disabled="selectedCards.length !== 3" 
        @click="confirmSelection" 
        class="text-white font-bold py-[6px] px-[2vw] my-[30px] border-[3px] border-blue-500 hover:border-blue-600
        hover:bg-blue-600 bg-blue-500 duration-300 shadow-sm rounded"
        :class="{ 'opacity-50 cursor-not-allowed': selectedCards.length !== 3 }">
        公開するカードを決定
      </button>
    </div>
    <div class="border border-gray-300 bg-white p-3 rounded overflow-auto h-[45vh] w-[90vw] mb-4 text-[2vh]">
      <div v-for="message in conversation" :key="message.id" class="mb-3">
        <div v-if="message.role === 'assistant'" class="text-blue-500 font-bold">
          <span>ChatGPT:</span> {{ message.content }}
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

  <!-- 英語版 -->
  <div v-else class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center pt-[1vh]">
    <ul class="flex flex-wrap gap-x-[1vh] justify-center items-center gap-y-[1vh] py-[1vh]">
      <li v-for="(card, index) in defenderCards" :key="card.id" class="border-[2px] border-blue-300 solid" :class="{ 'selected-border': selectedCards.includes(index + 1) }">
        <button @click="selectCard(index + 1)" class="w-[46vw] h-[10vh] bg-blue-300 justify-start items-center px-[2vw] duration-500 shadow-2xl flex">
          <img :src="`/img/${card.defender_card_name}.png`" alt="defender_card" class="w-[8vh] h-[8vh]">
          <p className="text-[2vh] font-bold pl-[1vw]">{{ card.defender_card_name }}</p>
        </button>
      </li>
    </ul>
    <div className="flex w-[95%] justify-center items-center text-[2vh]">
      <p className="text-blue-600 font-bold flex items-center justify-center mr-[6vw]">残り時間 : {{ timeLeft }}</p>
      <button 
        :disabled="selectedCards.length !== 3" 
        @click="confirmSelection" 
        class="text-white font-bold py-[6px] px-[2vw] my-[30px] border-[3px] border-blue-500 hover:border-blue-600
        hover:bg-blue-600 bg-blue-500 duration-300 shadow-sm rounded"
        :class="{ 'opacity-50 cursor-not-allowed': selectedCards.length !== 3 }">
        公開するカードを決定
      </button>
    </div>
    <div class="border border-gray-300 bg-white p-3 rounded overflow-auto h-[45vh] w-[90vw] mb-4 text-[2vh]">
      <div v-for="message in conversation" :key="message.id" class="mb-3">
        <div v-if="message.role === 'assistant'" class="text-blue-500 font-bold">
          <span>ChatGPT:</span> {{ message.content }}
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

  <!-- 対話開始モーダル 日本語 -->
  <div v-if="startModal && $i18n.locale === 'ja'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">対話開始</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">あなたが「他人に知られても良い」と感じる個人情報カードを、チャットボットと対話しながら3枚選択してください。制限時間は５分です。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeStartModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
          開始する
        </button>
      </div>
    </div>
  </div>

  <!-- 対話開始モーダル 英語 -->
  <div v-if="startModal && $i18n.locale === 'en'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">Start Conversation</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">あなたが「他人に知られても良い」と感じる個人情報カードを、チャットボットと対話しながら3枚選択してください。制限時間は５分です。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeStartModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
          開始する
        </button>
      </div>
    </div>
  </div>

  <!-- 対話終了モーダル 日本語 -->
  <div v-if="finishModal && $i18n.locale === 'ja'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">対話終了</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">制限時間の５分を経過しました。悪用サイドに渡す個人情報カードを3枚選択し、次の画面に進んでください。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeFinishModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
          閉じる
        </button>
      </div>
    </div>
  </div>

  <!-- 対話終了モーダル 英語 -->
  <div v-if="finishModal && $i18n.locale === 'en'" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
    <div class="relative mx-auto p-1 border w-[80vw] shadow-lg rounded-md bg-white">
      <p class="mt-2 px-[4vw] flex justify-center items-center text-[3vh] font-bold">Finish Conversation</p>
      <p class="mt-2 px-[4vw] py-[1vh] flex justify-center items-center text-[2vh]">制限時間の５分を経過しました。悪用サイドに渡す個人情報カードを3枚選択し、次の画面に進んでください。</p>
      <div class="items-center px-4 py-3">
        <button id="ok-btn" @click="closeFinishModal" class="px-4 py-2 bg-blue-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
          閉じる
        </button>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
import MenuComponent from './MenuComponent.vue';

export default {
  components: {
    MenuComponent
  },
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
      countdownTime: 5 * 60,
      timeLeft: '05:00',
      showSubmit: false,
      menuVisible: false,
      finishModal: false,
      startModal: true,
    };
  },
  async created() {
    try {
      this.userId = this.$route.params.user_id;
      this.gameId = this.$route.params.game_id;
      this.startModal = true;

      const userResponse = await axios.get(`/api/users/${this.userId}`);
      this.username = userResponse.data.username;

      const response = await axios.get(`/api/game/${this.gameId}`);
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
        path: `/result/${this.userId}/${this.gameId}/`,
        query: {
          selectedCards: this.selectedCards,
          attacker_select_id: this.attacker_select_id,
          role: 'defender',
          opponent_id: this.$route.query.opponent_id,
          win1: this.$route.query.win1,
          win2: this.$route.query.win2,
          win3: this.$route.query.win3,
          win4: this.$route.query.win4,
          win5: this.$route.query.win5,
          win6: this.$route.query.win6
        },
      });
    },
    startConversation() {
      axios.post(`http://localhost:8000/defender-select-dialogue/${this.username}/${this.gameId}/start`)
      // axios.post(`https://rma.iiojun.com/defender-select-dialogue/${this.username}/${this.gameId}/start`)
        .then(response => {
          this.conversation = response.data;
        })
        .catch(error => {
          console.error('Error starting conversation:', error);
        });
    },
    sendMessage() {
      const userMessage = { role: 'user', content: this.userInput };
      this.conversation.push(userMessage);
      this.userInput = '';

      const url = `http://localhost:8000/defender-select-dialogue/send-message`;
      // const url = `https://rma.iiojun.com/defender-select-dialogue/send-message`;
      const data = {
        message: userMessage.content,
        username: this.username,
        gameId: this.gameId,
        userId: this.$route.params.user_id
      };

      axios.post(url, data)
        .then(response => {
          this.conversation.push({ role: 'assistant', content: response.data.message });
        })
        .catch(error => {
          console.error('Error sending message:', error);
          this.conversation.pop();
        });
    },
    startCountdown() {
      const timerInterval = setInterval(() => {
        if (this.countdownTime === 0) {
          clearInterval(timerInterval);
          this.finishModal = true
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
    closeStartModal() {
      this.startModal = false;
      this.startCountdown();
    },
    closeFinishModal() {
      this.finishModal = false;
    }
  },
};
</script>

<style>
.selected-border {
  border: 2px solid #3b82f6;
}
</style>