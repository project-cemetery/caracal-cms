<template lang="html">
  <div class="app">
    <at-menu mode="horizontal" active-name="1">
     <at-menu-item name="1"><router-link to="/"><i class="icon icon-home"></i>Home</router-link></at-menu-item>
     <at-menu-item name="2"><router-link to="/login"><i class="icon icon-user"></i>Login</router-link></at-menu-item>
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

<style lang="css" scoped>
.app {
  display: flex;
  flex-direction: column;
  min-height: 100%;
}
</style>