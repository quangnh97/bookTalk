import 'es6-promise/auto'
import axios from 'axios'

import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import auth from './auth'

import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';



import router from './router'
import store from './store';

// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `http://127.0.0.1:8008/api`
Vue.use(VueAuth, auth)
import './bootstrap'
// Load Index
Vue.component('index', Index)

const app = new Vue({
  store,
  el: '#app',
  router,

});
