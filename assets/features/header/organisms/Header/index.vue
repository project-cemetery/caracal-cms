<template lang="html">
  <header class="header">
    <Logo></Logo>
    <Menu></Menu>
  </header>
</template>

<script>
import Menu from '../Menu'
import Logo from '@site/ui/atoms/Logo'

export default {
  name: 'appHeader',
  components: {Menu, Logo}
}
</script>

<style lang="css" scoped>
  .header {
    display: flex;
    align-items: center;
    padding: 0 2rem;
    border-bottom: 1px solid #e2ecf4;
  }
</style>
