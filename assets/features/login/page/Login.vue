<template lang="html">
  <div class="login">
    <div class="loginFormWrapper">
      <LoginForm />
    </div>
  </div>
</template>

<script>
import LoginForm from "../organisms/LoginForm";

export default {
  name: "Login",
  components: { LoginForm }
};
</script>

<style lang="css" scoped>
.login {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-grow: 1;
}
</style>
