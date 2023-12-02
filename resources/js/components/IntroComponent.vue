<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] flex justify-between items-center" :class="bgClass">
      <h1 class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">THE GUARDIAN</h1>
      <button @click="menuVisible = !menuVisible" class="text-white font-semibold text-[2.5vh] w-[3.5vh] h-[3.5vh] border-[3px] border-white rounded-full flex justify-center items-center mr-[5vw]">？</button>
      <MenuComponent
        v-model:modelValue="menuVisible"
        :gameId="parseInt($route.params.game_id)"
        :userId="parseInt($route.params.user_id)"
        :role="userRole"
      />
    </div>
  </div>

  <!-- 日本語版 -->
  <div v-if="$i18n.locale === 'ja'" class="w-[100vw] h-[92vh] bg-[#E5E5E5] py-[4vh] px-[5vw] text-[2.5vh]">
    <p>このゲームは、個人情報を題材としたシミュレーションカードゲーム。今回のあなたの対戦相手は
      <span v-if="opponentId === 31" class="font-bold">チャットボット</span>
      <span v-else class="font-bold">{{ this.opponentName }}</span>。
    </p>
    <p>あなたの役割は……</p>
    <div class="flex justify-center items-center pt-[1vh] pb-[4vh]">
      <p v-if="userRole === 'defender'" class="text-blue-500 font-bold p-[2vw] text-center w-[60vw] border-[5px] border-blue-500"> 個人情報提供サイド</p>
      <p v-else class="text-[#E76767] font-bold p-[2vw] text-center w-[60vw] border-[5px] border-[#E76767]"> 個人情報悪用サイド</p>
    </div>
    <div v-if="userRole === 'defender'">
      <p>
        <span v-if="opponentId === 31" class="font-bold">チャットボット</span>
        <span v-else class="font-bold">{{ this.opponentName }}</span>
        は個人情報の悪用手口を１つ選んでいて、あなたの個人情報狙っている！
      </p>
      <p v-if="opponentId === 31">ただ、チャットボットはあなたが意見を求めても一般的な回答しかできないよ！>_&lt; </p>
      <p>
        それぞれの個人情報カードに対する自分の考えを
        <span v-if="opponentId === 31">整理</span>
        <span class="font-bold" v-else-if="talk == 'chat'">「チャットで対話」</span>
        <span class="font-bold" v-else>「直接対話」</span>
        しながら、対戦相手に知られてもいいと思うカードを、最終的に５枚中３枚公開しよう。残りの手持ちカードがあなたの得点だ！
      </p>
    </div>
    <div v-else>
      <p>あなたは個人情報の悪用手口を1つ選び、その手口を成功させるために重要そうな「<span class="font-bold">{{ this.opponentName }}</span>」の個人情報カードを引き出そう！</p>
      <p>
        対戦相手には手口を悟られないように、それぞれの個人情報カードに対する考えを
        <span class="font-bold" v-if="talk == 'chat'">「チャットで対話」</span>
        <span class="font-bold" v-else>「直接対話」</span>
        しよう。個人情報提供サイドは、他人に知られてもいいと思うカードを、最終的に５枚中３枚公開する。公開されたカードがあなたの得点だ！
      </p>
    </div>
    <div v-if="opponentId === 31" class="flex justify-center items-center mt-[5vh] bg-blue-500 py-[1vh] px-[8vw] text-white font-bold">
      <router-link :to="{ name: 'defender-select-dialogue', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId, win_count: $route.query.win_count } }">
        チャットボット対戦に進む
      </router-link>
    </div>
    <div v-else-if="userRole === 'attacker' && trans == true && attackerTrans == true" class="flex justify-center items-center mt-[5vh] bg-[#E76767] py-[1vh] px-[8vw] text-white font-bold">
      <router-link :to="{ name: 'attacker-select', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId,  talk: this.talk, win_count: $route.query.win_count } }">
        個人情報悪用サイドへ進む
      </router-link>
    </div>
    <div v-else-if="userRole === 'attacker' && attackerTrans == false" class="flex justify-center items-center mt-[5vh] font-bold underline underline-offset-2 text-center">
      <p>個人情報提供側がスタンバイするまで少々お待ちください。</p>
    </div>
    <div v-else-if="userRole === 'defender' && trans == true" class="flex justify-center items-center mt-[5vh] bg-blue-500 py-[1vh] px-[8vw] text-white font-bold">
      <button @click="defenderTransit">
        個人情報提供サイドへ進む
      </button>
    </div>
    <div v-else-if="userRole === 'defender' && trans == false" class="flex justify-center items-center mt-[5vh] font-bold underline underline-offset-2 text-center">
      <p>個人情報悪用側がスタンバイするまで少々お待ちください。</p>
    </div>
  </div>

  <!-- 英語版 -->
  <div v-else class="w-[100vw] h-[92vh] bg-[#E5E5E5] py-[4vh] px-[5vw] text-[2.5vh]">
    <p>This gameは、個人情報を題材としたシミュレーションカードゲーム。今回のあなたの対戦相手は
      <span v-if="opponentId === 31" class="font-bold">チャットボット</span>
      <span v-else class="font-bold">{{ this.opponentName }}</span>。
    </p>
    <p>あなたの役割は……</p>
    <div class="flex justify-center items-center pt-[1vh] pb-[4vh]">
      <p v-if="userRole === 'defender'" class="text-blue-500 font-bold p-[2vw] text-center w-[60vw] border-[5px] border-blue-500"> 個人情報提供サイド</p>
      <p v-else class="text-[#E76767] font-bold p-[2vw] text-center w-[60vw] border-[5px] border-[#E76767]"> 個人情報悪用サイド</p>
    </div>
    <div v-if="userRole === 'defender'">
      <p>
        <span v-if="opponentId === 31" class="font-bold">チャットボット</span>
        <span v-else class="font-bold">{{ this.opponentName }}</span>
        は個人情報の悪用手口を１つ選んでいて、あなたの個人情報狙っている！
      </p>
      <p v-if="opponentId === 31">ただ、チャットボットはあなたが意見を求めても一般的な回答しかできないよ！>_&lt; </p>
      <p>
        それぞれの個人情報カードに対する自分の考えを
        <span v-if="opponentId === 31">整理</span>
        <span class="font-bold" v-else-if="talk == 'chat'">「チャットで対話」</span>
        <span class="font-bold" v-else>「直接対話」</span>
        しながら、対戦相手に知られてもいいと思うカードを、最終的に５枚中３枚公開しよう。残りの手持ちカードがあなたの得点だ！
      </p>
    </div>
    <div v-else>
      <p>あなたは個人情報の悪用手口を1つ選び、その手口を成功させるために重要そうな「<span class="font-bold">{{ this.opponentName }}</span>」の個人情報カードを引き出そう！</p>
      <p>
        対戦相手には手口を悟られないように、それぞれの個人情報カードに対する考えを
        <span class="font-bold" v-if="talk == 'chat'">「チャットで対話」</span>
        <span class="font-bold" v-else>「直接対話」</span>
        しよう。個人情報提供サイドは、他人に知られてもいいと思うカードを、最終的に５枚中３枚公開する。公開されたカードがあなたの得点だ！
      </p>
    </div>
    <div v-if="opponentId === 31" class="flex justify-center items-center mt-[5vh] bg-blue-500 py-[1vh] px-[8vw] text-white font-bold">
      <router-link :to="{ name: 'defender-select-dialogue', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId, win_count: $route.query.win_count } }">
        チャットボット対戦に進む
      </router-link>
    </div>
    <div v-else-if="userRole === 'attacker' && trans == true && attackerTrans == true" class="flex justify-center items-center mt-[5vh] bg-[#E76767] py-[1vh] px-[8vw] text-white font-bold">
      <router-link :to="{ name: 'attacker-select', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId,  talk: this.talk, win_count: $route.query.win_count } }">
        個人情報悪用サイドへ進む
      </router-link>
    </div>
    <div v-else-if="userRole === 'attacker' && attackerTrans == false" class="flex justify-center items-center mt-[5vh] font-bold underline underline-offset-2 text-center">
      <p>個人情報提供側がスタンバイするまで少々お待ちください。</p>
    </div>
    <div v-else-if="userRole === 'defender' && trans == true" class="flex justify-center items-center mt-[5vh] bg-blue-500 py-[1vh] px-[8vw] text-white font-bold">
      <button @click="defenderTransit">
        個人情報提供サイドへ進む
      </button>
    </div>
    <div v-else-if="userRole === 'defender' && trans == false" class="flex justify-center items-center mt-[5vh] font-bold underline underline-offset-2 text-center">
      <p>個人情報悪用側がスタンバイするまで少々お待ちください。</p>
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
      userRole: null,
      opponentId: null,
      opponentName: '',
      talk: '',
      user_id: null,
      game_id: null,
      bgClass: '',
      trans: false,
      attackerTrans: false,
      menuVisible: false,
    }
  },
  async mounted() {
    try {
      const response = await axios.get('/api/match-info', {
        params: {
          user_id: this.$route.params.user_id,
          game_id: this.$route.params.game_id,
        }
      });
      this.userRole = response.data.user_role;
      this.opponentId = response.data.opponent_id;
      this.talk = response.data.comunication;
      this.user_id = this.$route.params.user_id;
      this.game_id = this.$route.params.game_id;

      const userResponse = await axios.get(`/api/users/${this.opponentId}`);
      this.opponentName = userResponse.data.username;

      await axios.post(`/api/users/${this.user_id}/update-waiting-status`, {
          is_waiting: true
        });
      this.startWaitingCheck();

      if(this.userRole === 'attacker') {
        this.bgClass = 'bg-[#E76767]';
        Echo.private(`user.${this.$route.params.user_id}`)
            .listen('.defender.transit', (event) => {
              this.attackerTrans = event.transit;
        });
      } else if(this.userRole === 'defender') {
        this.bgClass = 'bg-blue-500';
      }
    } catch (error) {
      console.error('Error fetching match info:', error);
      this.userRole = null;
    }
  },
  methods: {
    startWaitingCheck() {
      this.waitingCheckInterval = setInterval(() => {
        this.checkOpponentWaitingStatus();
      }, 7000); // 7秒ごとに確認
    },
    async checkOpponentWaitingStatus() {
      try {
        const response = await axios.get(`/api/users/${this.opponentId}/waiting-status`);
        if(response.data.is_waiting) {
          clearInterval(this.waitingCheckInterval);
          this.trans = true;
        }
      } catch (error) {
        console.error('Error checking opponent waiting status:', error);
      }
    },
    defenderTransit(){
      const transit = true;
      const opponentId = this.opponentId;
      axios.post('/api/defender-transit', { transit, opponentId })
        .then(response => {
          this.$router.push({
            path: `/defender-standby/${this.$route.params.user_id}/${this.$route.params.game_id}`,
            query: {
              opponent_id: opponentId,
              talk: this.talk,
              win_count: this.$route.query.win_count
            }
          });
        })
        .catch(error => {
          console.error('エラーが発生しました', error);
        });
    },
  }
}
</script>
