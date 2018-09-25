<template lang="html">
  <b-navbar-brand>
    <router-link
      class="logo"
      to="/"
    >
      Caracal CMS
    </router-link>
  </b-navbar-brand>
</template>

<script>
export default {
  name: "Logo"
};
</script>

<style lang="css" scoped>
  .logo {
    display: block;
    color: #ffffff;
    font-size: 18px;
    margin-right: 1.5rem;
  }
</style>
