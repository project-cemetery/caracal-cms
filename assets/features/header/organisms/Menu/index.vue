<template>
  <b-navbar-nav class="ml-auto">
    <b-nav-item><router-link
      class="link"
      to="/"
    >Home</router-link></b-nav-item>
    <b-nav-item><router-link
      class="link"
      to="/auth"
    >Login</router-link></b-nav-item>
  </b-navbar-nav>
</template>

<script>
export default {
  name: 'AppMenu',
};
</script>

<style lang="css" scoped>
.link {
  text-decoration: none;
  color: #ffffff;
  &:hover,
  &:focus {
    text-decoration: underline;
  }
}
</style>
