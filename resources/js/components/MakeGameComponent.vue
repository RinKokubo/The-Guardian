<template>
  <!-- ヘッダ -->
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[100vw] flex justify-between items-center bg-green-600">
      <h1 class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">試合作成</h1>
    </div>
  </div>

  <div class="w-[100vw] h-[92vh] bg-[#E5E5E5] flex flex-col justify-center items-center gap-y-5">
    <div>
      <label for="gameCount">試合数選択：</label>
      <select id="gameCount" v-model="selectedGameCount" class="border border-gray-300 rounded px-4 py-2">
        <option v-for="number in 6" :key="number" :value="number">{{ number }}</option>
      </select>
    </div>
    <div>
      <label for="opponent">対戦相手選択：</label>
      <select id="opponent" v-model="selectedOpponent" class="border border-gray-300 rounded px-4 py-2">
        <option value='31'>チャットボット</option>
        <option v-for="number in opponentsRange" :key="number" :value="number">{{ number }}</option>
      </select>
    </div>
    <div>
      <label for="role">役割選択：</label>
      <select id="role" v-model="selectedRole" class="border border-gray-300 rounded px-4 py-2">
        <option value="defender">個人情報提供サイド</option>
        <option value="attacker">個人情報悪用サイド</option>
      </select>
    </div>
    <div>
      <label for="talk">対話方法選択：</label>
      <select id="talk" v-model="selectedTalk" class="border border-gray-300 rounded px-4 py-2">
        <option value="chat">チャット</option>
        <option value=" face">直接対話</option>
      </select>
    </div>
    <div class="flex justify-center items-center mt-[5vh] bg-green-600 py-[1vh] px-[8vw] text-white font-bold">
      <button @click="start">
        ゲーム開始
      </button>
    </div>
  </div>
</template>

<script>
  export default {
    name: "MakeGameComponent",
    data() {
      return {
        selectedGameCount: '',
        selectedOpponent: '',
        selectedRole: '',
        selectedTalk: '',
      };
    },
    methods: {
      start(){
        this.$router.push({ name: 'introduction', params: { user_id: this.$route.path.user_id, game_id: this.selectedGameCount }, query: { user_role: this.selectedRole, opponent_id: this.selectedOpponent, talk: this.selectedTalk, win1: '-', win2: '-', win3: '-', win4: '-', win5: '-', win6: '-' } });
      }
    },
    computed: {
      opponentsRange() {
        return Array.from({ length: 49 - 32 + 1 }, (v, k) => k + 32);
      }
    }
  }
</script>