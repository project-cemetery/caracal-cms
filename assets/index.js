import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './App.vue';

import Home from './features/home';
import Login from './features/login';

Vue.use(VueRouter);

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
