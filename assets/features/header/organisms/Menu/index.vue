<template lang="html">
  <at-menu class="menu" mode="horizontal" active-name="1">
    <at-menu-item name="1"><router-link to="/"><i class="icon icon-home"></i>Home</router-link></at-menu-item>
    <at-menu-item name="2"><router-link to="/login"><i class="icon icon-user"></i>Login</router-link></at-menu-item>
  </at-menu>
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