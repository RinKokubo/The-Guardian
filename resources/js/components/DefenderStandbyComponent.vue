<template>
  <div class="flex w-[100vw] h-[8vh] shadow-2xl">
    <div class="w-[15vw] bg-[#A49494] flex justify-center items-center">
      <p class="text-white text-[4vh] font-bold">{{ this.$route.params.game_id }}</p>
    </div>
    <div class="w-[85vw] bg-blue-500 flex justify-center items-center">
      <h1 class="w-[100%] text-[3vh] font-bold ml-[40px] text-white">悪用カード選択</h1>
      <button @click="menuVisible = !menuVisible" class="text-white font-semibold text-[2.5vh] w-[3.5vh] h-[3.5vh] border-[3px] border-white rounded-full flex justify-center items-center mr-[5vw]">？</button>
      <MenuComponent v-model:modelValue="menuVisible" />
    </div>
  </div>
  <div class="bg-[#E5E5E5] w-[100vw] h-[92vh] flex flex-col items-center">
    <div class="pt-[3vh] py-[1.5vh] flex flex-col items-center gap-y-5 text-[2vh]">
      <p>個人情報悪用側がカード選択中です。</p>
      <p>しばらくお待ちください。</p>
    </div>
    <div class="flex flex-col justify-center items-center gap-y-[4vh] py-[6vh]">
      <div v-for="i in 3" :key="i" 
              class="w-[90vw] h-[20vh] bg-red-300 justify-start items-center px-[3vw] flex shadow-2xl relative" 
              v-on:click="toggleCardSelection(i)">
        <img :src="`/img/${this['attackerCard' + i + 'Name']}.png`" alt="attacker_card" class="w-[16vh] h-[16vh]">
        <p class="text-[3vh] font-bold pl-[5vw]">{{ this['attackerCard' + i + 'Name'] }}</p>
        <button type="button" class="text-white font-bold text-[3vh] w-[3.5vh] h-[3.5vh] border-[2px] border-white rounded-full flex justify-center items-center absolute top-[1vh] right-[1vh] bg-red-500"
                @click.stop="openModal(i)">i</button>
      </div>
    </div>

    <!-- モーダル -->
    <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center" @click="closeModal">
      <div class="relative mx-auto p-5 border w-[85vw] shadow-lg rounded-md bg-white" @click.stop>
        <div class="mt-[2vh] text-center">
          <h3 class="text-[3vh] leading-6 font-bold text-gray-900 mb-[1vh]">{{ selectedName }}</h3>
          <div class="mt-2 px-[8vw] py-[2vh]">
            <p class="text-[2.5vh] text-gray-500">{{ selectedInfo }}</p>
          </div>
          <div class="items-center px-4 py-3">
            <button id="ok-btn" @click="closeModal" class="px-4 py-2 bg-red-500 text-white text-[3vh] font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">閉じる</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MenuComponent from './MenuComponent.vue';

export default {
  components: {
    MenuComponent
  },
    data() {
      return {
        userId: this.$route.params.user_id,
        selectedCard: null,
        attacker_select_id: null,
        attackerCard1Name: null,
        attackerCard2Name: null,
        attackerCard3Name: null,
        attacker_card1Info: '',
        attacker_card2Info: '',
        attacker_card3Info: '',
        showModal: false,
        menuVisible: false,
      };
    },
    created() {
      if(this.$route.params.game_id < 3){
        axios.get(`/api/game/${this.$route.params.game_id}`)
          .then(response => {
            this.gameInformation = response.data;
            this.attackerCard1Name = this.gameInformation.attacker_card1.attacker_card_name;
            this.attackerCard2Name = this.gameInformation.attacker_card2.attacker_card_name;
            this.attackerCard3Name = this.gameInformation.attacker_card3.attacker_card_name;
            
            return axios.get(`/api/attacker-card-info/${this.attackerCard1Name}`);
          })
          .then(response => {
            this.attacker_card1Info = response.data.attacker_card_info;
            return axios.get(`/api/attacker-card-info/${this.attackerCard2Name}`);
          })
          .then(response => {
            this.attacker_card2Info = response.data.attacker_card_info;
            return axios.get(`/api/attacker-card-info/${this.attackerCard3Name}`);
          })
          .then(response => {
            this.attacker_card3Info = response.data.attacker_card_info;
          })
          .catch(error => {
            console.error(error);
          });
      }
    },
    mounted() {
      console.log(`Connecting to channel: user.${this.userId}`);
      Echo.private(`user.${this.userId}`)
        .listen('.attackerCard.selected', (event) => {
          this.selectedCard = event.card;
          if(this.$route.query.talk == 'face'){
            this.$router.push({
              path: `/defender-select/${this.$route.params.user_id}/${this.$route.params.game_id}`,
              query: {
                opponent_id: this.$route.query.opponent_id,
                win_count: this.$route.query.win_count,
                selected_card: encodeURIComponent(this.selectedCard)
              }
            });
          } else {
            this.$router.push({
              path: `/defender-select-chat/${this.$route.params.user_id}/${this.$route.params.game_id}`,
              query: {
                opponent_id: this.$route.query.opponent_id,
                win_count: this.$route.query.win_count,
                selected_card: encodeURIComponent(this.selectedCard)
              }
            });
          }
        });
    },
    methods: {
      openModal(i) {
        this.selectedInfo = this['attacker_card' + i + 'Info']; // カードの情報をセット
        this.selectedName = this['attackerCard' + i + 'Name']; // カードの名前をセット
        this.showModal = true;
      },
      closeModal() {
        this.showModal = false;
      }
    }
  }
</script>
