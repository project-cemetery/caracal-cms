<template>
  <b-form
    class="form"
    @submit.prevent="onSubmit"
  >
    <b-form-group
      id="Username group"
      label="Username:"
      label-for="username"
    >
      <b-form-input
        id="username"
        v-model="form.username"
        type="text"
        required
      />
    </b-form-group>
    <b-form-group
      id="Password group"
      label="Password:"
      label-for="password"
    >
      <b-form-input
        id="password"
        v-model="form.password"
        type="password"
        required
      />
    </b-form-group>

    <b-button

      type="submit"
      variant="primary"
    >Submit</b-button>
  </b-form>
</template>

<script>
import ApiClient from '@site/apiClient';

export default {
  data: () => ({
    form: {
      username: '',
      password: '',
    },
  }),
  methods: {
    onSubmit() {
      ApiClient.login(JSON.stringify(this.form));
    },
  },
};
</script>

<style lang="css" scoped>
.form {
  padding: 2em;
  border-radius: 5px;
  border: 1px solid var(--primary);
}
</style>
