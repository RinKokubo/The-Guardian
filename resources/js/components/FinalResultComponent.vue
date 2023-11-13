<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[100vw] bg-green-600 flex justify-center items-center">
      <h1 className="w-[100%] text-[3vh] font-bold ml-[14vw] text-white">最終結果</h1>
    </div>
  </div>
  <div className="flex flex-col items-center bg-[#E5E5E5] w-[100vw] h-[92vh]">
    <div className="flex flex-col items-center pt-[3vh] pb-[1vh]" id="result">
      <img :src="`/img/win${$route.query.win_count}.png`" alt="result" class="w-[40vw] h-[40vw]">
    </div>
    <div class="flex flex-col justify-center items-center gap-y-5 mt-[3vh] mb-[5vh] text-[3vh] font-bold">
      <div v-if="$route.query.win_count == 6">
        <p>あなたのランク： ダイヤモンド</p>
        <p>さすがだ、素晴らしい...!!!</p>
      </div>
      <div v-else-if="$route.query.win_count == 5">
        <p>あなたのランク： プラチナ</p>
        <p>すごい！全勝まであと一歩！！！</p>
      </div>
      <div v-else-if="$route.query.win_count == 4">
        <p>あなたのランク： ゴールド</p>
        <p>いいぞ〜！この調子！！</p>
      </div>
      <div v-else-if="$route.query.win_count == 3">
        <p>あなたのランク： シルバー</p>
        <p>慣れてきたね！いい感じ！</p>
      </div>
      <div v-else-if="$route.query.win_count == 2">
        <p>あなたのランク： ブロンズ</p>
        <p>小さなヒントも見逃すなよ！</p>
      </div>
      <div v-else-if="$route.query.win_count == 1">
        <p>あなたのランク： アイアン</p>
        <p>伸び代はある！涙を拭こう！</p>
      </div>
      <div v-else>
        <p>あなたのランク： ビギナー</p>
        <p>今日はとことん落ち込もう...</p>
      </div>
    </div>
    <router-link to="/"
      className="bg-green-600 text-white font-bold py-[1vh] px-[20vw] text-[2vh] shadow-md hover:bg-green-700 duration-300">
      ゲームを終了する
    </router-link>
  </div>
</template>

<script>
//import axios from 'axios'

export default {
  name: "FinalResultComponent",
};
</script>
