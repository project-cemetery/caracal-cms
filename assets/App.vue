<template lang="html">
  <div class="app">
    <at-menu mode="horizontal" active-name="1">
      <router-link to="/">Home</router-link>
      <router-link to="/login">Login</router-link>
    </at-menu>
    <div>
    </div>
    <template v-if="$route.matched.length">
      <router-view></router-view>
    </template>
  </div>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style lang="css">
html,
body {
  height: 100%;
}
body {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial,
    sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
}

.app {
  display: flex;
  flex-direction: column;
  min-height: 100%;
}

h1 {
  font-weight: 300;
}
</style>