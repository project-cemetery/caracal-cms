<template lang="html">
  <header class="header">
    <b-navbar
      toggleable="md"
      type="dark"
      variant="info"
      class="navBar"
    >

      <b-navbar-toggle target="nav_collapse" />

      <Logo />

      <b-collapse
        id="nav_collapse"
        is-nav
      >

        <Menu />

      </b-collapse>
    </b-navbar>
  </header>
</template>

<script>
import Menu from "../Menu";
import Logo from "@site/ui/atoms/Logo";

export default {
  name: "AppHeader",
  components: { Menu, Logo }
};
</script>

<style lang="css" scoped>
.header {
  display: flex;
  align-items: center;
  justify-content: center;
}

.navBar {
  width: 100%;
  max-width: 1600px;
  border-bottom: 1px solid #e2ecf4;
}
</style>
