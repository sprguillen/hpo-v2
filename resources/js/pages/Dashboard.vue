<template>
  <div class="dashboard">
    <Header />
    <Menu />
  </div>
</template>

<script>
import Header from '@/components/global/Header'
import Menu from '@/components/global/Menu'

export default {
  components: {
    Header,
    Menu
  }
}
</script>
<style lang="scss" scoped>
  @import "../../sass/pages/dashboard.scss";
</style>
