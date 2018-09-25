<template lang="html">
  <div>
    <router-link to="/"><i class="icon icon-home"></i>Home</router-link>
    <router-link to="/auth"><i class="icon icon-user"></i>Login</router-link>
  </div>
</template>

<script>
export default {
  name: 'appMenu'
}
</script>

<style lang="css" scoped>
  .menu {
    margin-bottom: -1px;
  }
</style>