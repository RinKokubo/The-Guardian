<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] flex justify-center items-center" :class="bgClass">
      <h1 class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">個人情報保護ゲーム</h1>
    </div>
  </div>
  <div class="w-[100vw] h-[92vh] bg-[#E5E5E5] py-[4vh] px-[5vw] text-[2.5vh]">
    <p>このゲームは、1対1で行うロールプレイングカードゲーム。今回のあなたの対戦相手は
      <span v-if="opponentId === 31">チャットボット</span>
      <span v-else>{{ this.opponentName }}</span>。
    </p>
    <p>あなたの役割は..</p>
    <div class="flex justify-center items-center pt-[1vh] pb-[4vh]">
      <p v-if="userRole === 'defender'" class="text-white font-bold p-[2vw] text-center w-[65vw]" :class="bgClass"> 個人情報提供サイド</p>
      <p v-else class="text-white font-bold p-[2vw] text-center w-[65vw]" :class="bgClass"> 個人情報悪用サイド</p>
    </div>
    <p>
      <span v-if="userRole === 'defender'">
        <span v-if="opponentId === 31">チャットボット</span>
        <span v-else>{{ this.opponentName }}</span>
        は個人情報の悪用手口を１つ選んでいて、あなたの個人情報カードを狙っている！ それぞれの個人情報カードに対する考えをチャットしながら、対戦相手に知られてもいいと思うカードを、最終的に５枚中３枚公開しよう！残りの手持ちカードがあなたの得点だ。
      </span>
      <span v-else>
        あなたは、悪用手口を1つ選び、その手口を成立させるために重要そうな{{ this.opponentName }}の個人情報カードを狙う！
        {{ this.opponentName }}には手口を悟られないように、それぞれの個人情報カードに対する考えをチャットしよう。対戦相手は、あなたに知られてもいいと思うカードを、最終的に５枚中３枚公開する。公開されたカードがあなたの得点だ！
      </span>
    </p>
    
    <div v-if="opponentId === 31" class="flex justify-center items-center mt-[5vh] bg-blue-500 py-[1vh] px-[8vw] text-white font-bold">
      <router-link :to="{ name: 'defender-select-dialogue', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId, win_count: $route.query.win_count } }">
        ChatGPT対戦に進む
      </router-link>
    </div>
    <div v-else-if="userRole === 'attacker'" class="flex justify-center items-center mt-[5vh] bg-[#E76767] py-[1vh] px-[8vw] text-white font-bold">
      <router-link :to="{ name: 'attacker-select', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId,  talk: this.talk, win_count: $route.query.win_count } }">
        個人情報悪用サイドへ進む
      </router-link>
    </div>
    <div v-else-if="userRole === 'defender'" class="flex justify-center items-center mt-[5vh] bg-blue-500 py-[1vh] px-[8vw] text-white font-bold">
      <router-link :to="{ name: 'defender-standby', params: { user_id: user_id, game_id: game_id }, query: { opponent_id: opponentId, talk: this.talk, win_count: $route.query.win_count } }">
        個人情報提供サイドへ進む
      </router-link>
      <!--提供側が次のページへ遷移したとき、つまりrouter-link :to="{ name: 'defender-standby'..を押下した時に対戦相手に通知したい-->
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "IntroComponent",
  data() {
    return {
      userRole: null,
      opponentId: null,
      opponentName: '',
      talk: '',
      user_id: null,
      game_id: null,
      bgClass: '' 
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

      const userResponse = await axios.get(`http://localhost:8000/api/users/${this.opponentId}`);
      this.opponentName = userResponse.data.username;

      if(this.userRole === 'attacker') {
        this.bgClass = 'bg-[#E76767]';
      } else if(this.userRole === 'defender') {
        this.bgClass = 'bg-blue-500';
      }
    } catch (error) {
      console.error('Error fetching match info:', error);
      this.userRole = null;
    }
  },
  methods: {
    defenderTransit(){
      const transit = true;
      const opponentId = this.$route.query.opponent_id;

      axios.post('/api/defender-transit', { transit, opponentId })
        .then(response => {
          console.log('遷移情報を送信しました');
          console.log(opponentId);
          this.$router.push({
            path: `/defender-standby/${userId}/${gameId}`,
            query: {
              opponent_id: opponentId,
              talk: this.talk,
              win_count: $route.query.win_count
            }
          });
        })
        .catch(error => {
          console.error('エラーが発生しました', error);
        });
    }
  }
}
</script>
