<template>
  <!-- ヘッダ -->
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[100vw] bg-green-600 flex justify-center items-center">
      <h1 v-if="$i18n.locale === 'ja'" className="w-[100%] text-[3vh] font-bold ml-[13vw] text-white">最終結果</h1>
      <h1 v-else className="w-[100%] text-[3vh] font-bold ml-[13vw] text-white">Final Result</h1>
    </div>
  </div>

  <!-- 日本語版 -->
  <div v-if="$i18n.locale === 'ja'" className="flex flex-col items-center bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div className="flex flex-col items-center pt-[3vh] pb-[1vh]" id="result">
      <img :src="`/img/win${winCount}.png`" alt="result" class="w-[30vw] h-[30vw]">
    </div>
    <div class="flex flex-col justify-center items-center gap-y-5 mt-[3vh] mb-[5vh] text-[3vh] font-bold">
      <p class="font-bold text-[5vh] text-red-500">{{ winCount }} 勝</p>
      <div v-if="winCount == 6">
        <p>あなたのランク： ダイヤモンド</p>
        <p>さすがだ、素晴らしい...!!!</p>
      </div>
      <div v-else-if="winCount == 5">
        <p>あなたのランク： プラチナ</p>
        <p>すごい！全勝まであと一歩！！！</p>
      </div>
      <div v-else-if="winCount == 4">
        <p>あなたのランク： ゴールド</p>
        <p>いいぞ〜！この調子！！</p>
      </div>
      <div v-else-if="winCount == 3">
        <p>あなたのランク： シルバー</p>
        <p>慣れてきたね！いい感じ！</p>
      </div>
      <div v-else-if="winCount == 2">
        <p>あなたのランク： ブロンズ</p>
        <p>小さなヒントも見逃すなよ！</p>
      </div>
      <div v-else-if="winCount == 1">
        <p>あなたのランク： アイアン</p>
        <p>伸び代はある！涙を拭こう！</p>
      </div>
      <div v-else>
        <p>あなたのランク： ビギナー</p>
        <p>今日はとことん落ち込もう...</p>
      </div>
      <table class="text-[2vh] font-bold bg-white border-collapse border-2 border-green-700">
        <thead class="uppercase">
          <tr>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">試合</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">１</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">２</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">３</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">４</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">５</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">６</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">結果</th>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win1 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win2 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win3 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win4 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win5 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win6 }}</td>
          </tr>
        </tbody>
      </table>      
      <p>★ 遊んでくれてありがとう ★</p>
    </div>
    <router-link to="/"
      className="bg-green-600 text-white font-bold py-[1vh] px-[20vw] text-[2vh] shadow-md hover:bg-green-700 duration-300">
      ゲームを終了する
    </router-link>
  </div>

  <!-- 英語版 -->
  <div v-else className="flex flex-col items-center bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div className="flex flex-col items-center pt-[3vh] pb-[1vh]" id="result">
      <img :src="`/img/win${winCount}.png`" alt="result" class="w-[30vw] h-[30vw]">
    </div>
    <div class="flex flex-col justify-center items-center gap-y-5 mt-[3vh] mb-[5vh] text-[3vh] font-bold">
      <p class="font-bold text-[5vh] text-red-500">{{ winCount }} 勝</p>
      <div v-if="winCount == 6">
        <p>Your Rank： ダイヤモンド</p>
        <p>さすがだ、素晴らしい...!!!</p>
      </div>
      <div v-else-if="winCount == 5">
        <p>Your Rank： プラチナ</p>
        <p>すごい！全勝まであと一歩！！！</p>
      </div>
      <div v-else-if="winCount == 4">
        <p>Your Rank： ゴールド</p>
        <p>いいぞ〜！この調子！！</p>
      </div>
      <div v-else-if="winCount == 3">
        <p>Your Rank： シルバー</p>
        <p>慣れてきたね！いい感じ！</p>
      </div>
      <div v-else-if="winCount == 2">
        <p>Your Rank： ブロンズ</p>
        <p>小さなヒントも見逃すなよ！</p>
      </div>
      <div v-else-if="winCount == 1">
        <p>Your Rank： アイアン</p>
        <p>伸び代はある！涙を拭こう！</p>
      </div>
      <div v-else>
        <p>Your Rank： ビギナー</p>
        <p>今日はとことん落ち込もう...</p>
      </div> 
      <table class="text-[2vh] font-bold bg-white border-collapse border-2 border-green-700">
        <thead class="uppercase">
          <tr>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">試合</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">１</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">２</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">３</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">４</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">５</th>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">６</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="col" class="py-3 px-3 border-2 border-green-700">結果</th>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win1 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win2 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win3 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win4 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win5 }}</td>
            <td class="py-3 px-3 border-2 border-green-700">{{ this.$route.query.win6 }}</td>
          </tr>
        </tbody>
      </table>      
      <p>★ 遊んでくれてありがとう ★</p>
    </div>
    <router-link to="/"
      className="bg-green-600 text-white font-bold py-[1vh] px-[20vw] text-[2vh] shadow-md hover:bg-green-700 duration-300">
      ゲームを終了する
    </router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      winCount: 0,
    };
  },
  methods: {
    calculateWinCount() {
      for (let i = 1; i <= 6; i++) {
        if (this.$route?.query[`win${i}`] === '○') {
          this.winCount += 1;
        }
      }
    }
  },
  created() {
    this.calculateWinCount();
  }
}

</script>
