<template>
  <div class="dashboard">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="col-lg-12 page-content">

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
  @import "../../sass/pages/dashboard.scss";
</style>
