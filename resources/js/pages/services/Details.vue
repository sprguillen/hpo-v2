<template>
  <div class="service-details">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column is-full no-left-padding">
            <router-link to="/services">
              <b-button
                type="is-danger"
                icon-left="keyboard-backspace"
              >
                Back
              </b-button>
            </router-link>
          </div>
          <div class="column" />
          <div class="column portlet">
            <h1 class="float-left">
              12 L ECG W/LONGLEAD2PROMO
            </h1>
            <div class="clearfix" />
            <hr>
            <div class="column">
              <div class="columns is-mobile">
                <div class="column">
                  <p class="bd-notification is-info">
                    <strong>Code:</strong><br>12LECP
                  </p>
                </div>
                <div class="column">
                  <p class="bd-notification is-info">
                    <strong>Default cost:</strong><br>P 1000.00
                  </p>
                </div>
              </div>
            </div>
            <div class="column">
              <div class="columns is-mobile">
                <div class="column">
                  <p class="bd-notification is-info">
                    <strong>No. of clients:</strong><br>4
                  </p>
                </div>
                <div class="column">
                  <p class="bd-notification is-info">
                    <strong>No. of orders:</strong><br>6
                  </p>
                </div>
              </div>
            </div>
            <div class="column" />
            <h1 class="float-left">
              Clients
            </h1>
            <div class="clearfix" />
            <hr>
            <div class="column is-full no-left-padding">
              <b-button
                type="app-primary"
                icon-right="plus"
              >
                Add Client
              </b-button>
            </div>
            <div class="column" />
            <div class="column portlet">
              <ClientList :clients="clientsList" />
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Header from '@/components/global/Header'
import ClientList from '@/components/services/ClientList'

export default {
  components: {
    Header,
    ClientList
  },
  data() {
    return {
      clientsList: [
        { client: 'dswd3126', price: 'P 472.50' }
      ]
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/services/details.scss";
</style>
