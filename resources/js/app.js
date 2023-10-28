/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue'
import axios from 'axios';

import Hello from './components/HelloComponent';
import SelectAccount from './components/SelectAccountComponent';
import Introduction from './components/IntroComponent';
import Talk from './components/TalkComponent';
import Result from './components/ResultComponent';
import UserScore from './components/UserScoreComponent';
import AttackerSelect from './components/AttackerSelectComponent';

 window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


const routes = [
  {
    path: '/',
    component: Hello,
  },
  {
    path: '/select-account',
    component: SelectAccount,
  },
  {
    path: '/introduction/:user_id/:game_id',
    component: Introduction, name: 'introduction'
  },
  {
    path: '/attacker-select/:user_id/:game_id',
    component: AttackerSelect, name: 'attacker-select'
  },
  {
    path: '/defender-select-dialogue/:user_id/:game_id',
    component: Talk, name: 'defender-select-dialogue'
  },
  {
    path: '/result/:username/:id',
    component: Result, name: 'result'
  }
  ,
  {
    path: '/user-score/:username/:id',
    component: UserScore, name: 'user-score'
  }
];


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = createRouter({
  history: createWebHistory(),
  routes, // `routes: routes` の短縮記法
})

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

createApp(App).use(router).mount('#app')