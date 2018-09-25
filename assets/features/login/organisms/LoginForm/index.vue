<template lang="html">
  <form v-model="valid">

    <input></input>
  </form>
</template>

<script>
import ApiClient from "@site/apiClient";

export default {
    data: () => ({
      valid: false,
      username: '',
      usernameRules: [
        v => !!v || 'username is required',
      ],
      password: '',
      emailRules: [
        v => !!v || 'password is required',
      ]
    })
  }
</script>

<style lang="css" scoped>
.input {
  margin-bottom: 1rem;
  padding: 0.4em 1em;
  border-radius: 3px;
  border: 1px solid #6190e8;
  display: block;
}

.button {
  /* background-color: #6190E8;
  border: */
}
</style>