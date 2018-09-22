<template lang="html">
  <div class="app">
    <Header></Header>
    <template v-if="$route.matched.length">
      <router-view></router-view>
    </template>
  </div>
</template>

<script>
import Header from "@site/features/header";
export default {
  name: 'app',
  components: {Header}
}
</script>

<style lang="css" scoped>
.app {
  display: flex;
  flex-direction: column;
  min-height: 100%;
}
</style>