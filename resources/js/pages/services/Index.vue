<template>
  <div class="services">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Header from '@/components/global/Header'

export default {
  components: {
    Header
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/services/index.scss";
</style>
