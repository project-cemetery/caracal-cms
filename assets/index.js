import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import BootstrapVue from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import './index.css';

import App from './App.vue';

import Home from './features/home';
import Login from './features/login';

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(BootstrapVue);

const routes = [
  {
    path: '/',
    component: Home,
  },
  {
    path: '/auth',
    component: Login,
  },
];

const router = new VueRouter({
  mode: 'history',
  routes,
});

new Vue({
  el: document.body,
  router,
  render: h => h(App),
});
