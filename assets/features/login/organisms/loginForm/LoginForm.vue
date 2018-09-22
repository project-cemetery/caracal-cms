<template lang="html">
  <form @submit="login" action="">
    <at-input class="input" v-model="username" placeholder="Username" required></at-input>
    <at-input class="input" v-model="password" type="password" placeholder="Password" required></at-input>
    <at-button @click="login" type="primary">Login</at-button>
  </form>
</template>

<script>
import ApiClient from "@site/apiClient";

export default {
  name: 'loginForm',
  data: () => ({
    password: '',
    username: ''
  }),
  methods: {
    login: function() {
        const userCredentials = new FormData()
        userCredentials.append('username', this.username)
        userCredentials.append('password', this.password)

        ApiClient.login(userCredentials)

    }
  }
}
</script>

<style lang="css" scoped>
.input {
  margin-bottom: 1rem;
}
</style>