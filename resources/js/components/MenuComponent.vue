<template>
  <transition name="slide">
    <div v-if="modelValue" class="menu-container">
      <div class="flex flex-col items-center menu-content">
        <p class="text-[3vh] text-white my-[1.8vh] font-bold">メニュー</p>
        <div class="text-[2.5vh] text-white py-[1vh] text-center border-[1.5px] border-white w-full">
          <p>あなたは{{ this.username }}</p>
          <p>あなたの役割は
            <span v-if="role === 'defender'" class="font-bold">個人情報提供サイド</span>
            <span v-else class="font-bold">個人情報悪用サイド</span>
          </p>
        </div>
        <p class="game-rules-title px-4 py-2 bg-green-600 text-white text-[3vh] text-center border-[1.5px] border-white w-full font-bold" @click="toggleCardVisibility">
          カードの選択肢
        </p>
        <div v-if="isCardVisible" class="game-rules bg-green-200 p-3 text-[2vh] w-full">
          <div v-if="role === 'attacker'" class="flex flex-col gap-y-[1vh]">
            <p class="text-red-500 font-bold">{{ attackerCard1 }}</p>
            <p>{{ attackerInfo1 }}</p>
            <p class="text-red-500 font-bold">{{ attackerCard2 }}</p>
            <p>{{ attackerInfo2 }}</p>
            <p class="text-red-500 font-bold">{{ attackerCard3 }}</p>
            <p>{{ attackerInfo3 }}</p>
          </div>
          <div v-else class="flex flex-col gap-y-[1vh] text-blue-500 font-bold items-center">
            <p>{{ defenderCard1 }}</p>
            <p>{{ defenderCard2 }}</p>
            <p>{{ defenderCard3 }}</p>
            <p>{{ defenderCard4 }}</p>
            <p>{{ defenderCard5 }}</p>
          </div>
        </div>
        <p class="game-rules-title px-4 py-2 bg-green-600 text-white text-[3vh] text-center border-[1.5px] border-white w-full font-bold" @click="toggleTalkVisibility">
          会話のヒント
        </p>
        <div v-if="isTalkVisible" class="game-rules bg-green-200 p-3 text-[2vh] flex flex-col gap-y-[1vh]">
          <p class="bg-blue-300 font-bold pl-3 py-[2px]">「原則」</p>
          <p>悪用サイドも提供サイドも、選択した手口を探るような質問以外には、正直に答えよう！犯罪に関する一般的な質問はOK！</p>
          <p class="bg-blue-300 font-bold pl-3 py-[2px]">「質問集」</p>
          <p>
            ・5枚のカードの中で1番知られても良いと思うものはどれ？それはなぜ？<br>
            ・そのカードは1枚でも重要な情報？<br>
            ・その情報は他のカードと組み合わせると危険性を増さない？<br>
            ・そのカードは汎用性が高くない？<br>
            ・〇〇詐欺とかに信憑性を持たせる情報として使われそうじゃない？<br>
            ・〇〇詐欺ってどういう手口だっけ？
          </p>
          <p>
            ×どのカードが欲しい？<br>
            ×どの悪用手口を選んだの？結婚詐欺？<br>
          </p>
        </div>
        <p class="game-rules-title px-4 py-2 bg-green-600 text-white text-[3vh] text-center border-[1.5px] border-white w-full font-bold" @click="toggleRulesVisibility">
          ゲームルール
        </p>
        <div v-if="isRulesVisible" class="game-rules bg-green-200 p-3 text-[2vh] flex flex-col gap-y-[1vh]">
          <p><span class="text-blue-500 font-bold">個人情報提供サイド</span>/<span class="text-red-500 font-bold">個人情報悪用サイド</span>に分かれて行うシミュレーションカードゲーム。</p>
          <p><span class="text-blue-500 font-bold">提供サイド</span><br>
            ① 5枚の個人情報カードが配られる。5枚のカードは、合計100点になるよう点数付けされている。ただし点数は、悪用手口によって変化する。例: 空き巣にとって、住所は重要度が高い→点数が高い。<br>
            ② 5分間の対戦相手との対話を経て、他人に知られてもいいと思う3枚のカードを公開する。残った手持ちの2枚が、提供サイドの得点となる。
          </p>
          <img :src="`/img/提供例.jpg`" alt="提供例" class="my-[5px]">
          <p><span class="text-red-500 font-bold">悪用サイド</span><br>
            ① 3枚の悪用手口から1つ選択する。<br>
            ② 提供サイドの個人情報カード選択肢を見て、①で選択した悪用手口にとって、どのカードが重要か考える（どのカードを公開してほしいか考える）。<br>
            ③ 対戦相手に悪用手口を悟られないよう気をつけながら、対話を主導する。勝つヒント：他の個人情報悪用手口（選択肢以外でも）は、どのカードが重要か考える。相手が公開した3枚のカードが、悪用サイドの得点になる。<br>
          </p>
          <img :src="`/img/得点例.jpg`" alt="提供例" class="my-[5px]">
          <p>得点が高い方が勝利！負けても、個人情報が悪用される場面を考えながら対話ができていればオールオッケー！相手との話を楽しもう！</p>
        </div>
        <p class="game-rules-title px-4 py-2 bg-green-600 text-white text-[3vh] text-center border-[1.5px] border-white w-full font-bold" @click="toggleLangVisibility">
          言語選択
        </p>
        <div v-if="isLangVisible" class="game-rules bg-green-200 p-3 text-[2vh] flex flex-col gap-y-[1vh] w-full items-center">
          <p>日本語</p>
          <p>English</p>
        </div>
        <button @click="closeMenu" class="close-button px-4 py-2 bg-green-700 text-white text-[3vh]
          font-medium w-full shadow-sm hover:bg-green-400 focus:outline-none">
          閉じる
        </button>
      </div>
    </div>
  </transition>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    modelValue: Boolean,
    gameId: Number,
    userId: Number,
    role: String
  },
  data() {
    return {
      isRulesVisible: false,
      isCardVisible: false,
      isLangVisible: false,
      isTalkVisible: false,
      username: '',
      attackerCard1: '',
      attackerCard2: '',
      attackerCard3: '',
      defenderCard1: '',
      defenderCard2: '',
      defenderCard3: '',
      defenderCard4: '',
      defenderCard5: '',
      attackerInfo1: '',
      attackerInfo2: '',
      attackerInfo3: '',
    };
  },
  emits: ['update:modelValue'],
  async mounted() {
    try {
      const userResponse = await axios.get(`/api/users/${this.userId}`);
      this.username = userResponse.data.username;

      const gameResponse = await axios.get(`/api/game/${this.gameId}`);
      this.attackerCard1 = gameResponse.data.attacker_card1.attacker_card_name;
      this.attackerCard2 = gameResponse.data.attacker_card2.attacker_card_name;
      this.attackerCard3 = gameResponse.data.attacker_card3.attacker_card_name;

      this.defenderCard1 = gameResponse.data.defender_card1.defender_card_name;
      this.defenderCard2 = gameResponse.data.defender_card2.defender_card_name;
      this.defenderCard3 = gameResponse.data.defender_card3.defender_card_name;
      this.defenderCard4 = gameResponse.data.defender_card4.defender_card_name;
      this.defenderCard5 = gameResponse.data.defender_card5.defender_card_name;

      const attackerResponse1 = await axios.get(`/api/attacker-card-info/${this.attackerCard1}`);
      this.attackerInfo1 = attackerResponse1.data.attacker_card_info;
      const attackerResponse2 = await axios.get(`/api/attacker-card-info/${this.attackerCard2}`);
      this.attackerInfo2 = attackerResponse2.data.attacker_card_info;
      const attackerResponse3 = await axios.get(`/api/attacker-card-info/${this.attackerCard3}`);
      this.attackerInfo3 = attackerResponse3.data.attacker_card_info;
    } catch (error) {
      console.error('ユーザー情報の取得に失敗しました', error);
    }
  },
  methods: {
    closeMenu() {
      this.$emit('update:modelValue', false);
    },
    toggleRulesVisibility() {
      this.isRulesVisible = !this.isRulesVisible;
    },
    toggleCardVisibility() {
      this.isCardVisible = !this.isCardVisible;
    },
    toggleLangVisibility() {
      this.isLangVisible = !this.isLangVisible;
    },
    toggleTalkVisibility() {
      this.isTalkVisible = !this.isTalkVisible;
    },
  }
}
</script>

<style scoped>
.menu-container {
  position: fixed;
  top: 0;
  right: 0;
  width: 90vw;
  height: 100%;
  background: #16a34a;
  z-index: 1000;
}

.menu-content {
  overflow-y: auto;
  height: 100%;
  width: 100%;
  background: #16a34a;
}

.game-rules-title {
  cursor: pointer;
}

.slide-enter-active, .slide-leave-active {
  transition: transform 0.3s;
}

.slide-enter, .slide-leave-to {
  transform: translateX(100%);
}
</style>
