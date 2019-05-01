<template>
  <div class="services">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column is-full no-left-padding">
            <b-button type="app-primary" v-if="!addMode" @click="addMode = true" icon-right="plus">Add a Service</b-button>
            <b-button type="app-primary" @click="importFile" icon-right="cloud-download">Import</b-button>
          </div>
          <AddService v-if="addMode" @hide="addMode = false" />
          <div class="column" />
          <div class="column" />
          <div class="column portlet">
            <List :services="servicesList" />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Header from '@/components/global/Header'
import AddService from '@/components/services/AddService'
import List from '@/components/services/List'

export default {
  components: {
    Header,
    AddService,
    List
  },
  data() {
    return {
      servicesList: [
        {
          code: 'OXCAR9',
          name: '10-OH Oxcarbazepine',
          default_cost: 'P 1000.00',
          no_clients: 6,
          no_orders: 4
        },
        {
          code: '12UALB',
          name: '12 Hour Urine Albumin',
          default_cost: 'P 800.00',
          no_clients: 4,
          no_orders: 6
        },
        {
          code: '12UCRE',
          name: '12 Hour Urine Creatinine',
          default_cost: 'P 700.00',
          no_clients: 4,
          no_orders: 6
        }
      ],
      addMode: false
    }
  },
  methods: {
    importFile() {

    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/services/index.scss";
</style>
