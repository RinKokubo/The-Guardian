<template>
  <transition name="slide">
    <div v-if="modelValue" class="menu-container">
      <div class="flex flex-col items-center">
        <p class="text-[2.5vh] text-white my-[2vh]">メニューの内容</p>
        <button @click="closeMenu" class="close-button px-4 py-2 bg-green-700 text-white text-[3vh]
          font-medium rounded-md w-full shadow-sm hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-400">
          閉じる
        </button>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    modelValue: Boolean 
  },
  emits: ['update:modelValue'],
  methods: {
    closeMenu() {
      this.$emit('update:modelValue', false);
    }
  }
}
</script>

<style scoped>
.menu-container {
  position: fixed;
  top: 0;
  right: 0;
  width: 85vw;
  height: 100%;
  background: #16a34a;
}

.slide-enter-active, .slide-leave-active {
  transition: transform 0.3s;
}

.slide-enter, .slide-leave-to {
  transform: translateX(100%);
}
</style>
