<template>
  <div class="client-details">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column is-full no-left-padding">
            <router-link to="/clients">
              <b-button type="is-danger" icon-left="keyboard-backspace">
                Back
              </b-button>
            </router-link>
          </div>
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
  @import "../../../sass/pages/clients/details.scss";
</style>
