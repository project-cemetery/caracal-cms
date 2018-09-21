import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import AtComponents from 'at-ui';
import 'at-ui-style';
import './index.css';

import App from './App.vue';

import Home from './features/home';
import Login from './features/login';

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(AtComponents);

const routes = [
  {
    path: '/',
    component: Home,
  },
  {
    path: '/login',
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
