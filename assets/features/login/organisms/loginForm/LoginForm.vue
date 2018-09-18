<template lang="html">
  <form action="">
    <at-input class="input" v-model="password" type="password" placeholder="Password" required></at-input>
    <at-input class="input" v-model="username" placeholder="Username" required></at-input>
    <at-button type="primary">Login</at-button>
  </form>
</template>

<script>
export default {
  name: 'loginForm',
  data: () => ({
    password: '',
    username: ''
  })
}
</script>

<style lang="css" scoped>
</style>