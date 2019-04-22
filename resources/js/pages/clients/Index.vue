<template>
  <div class="clients">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <AddClient v-if="addMode" @hide="addMode = false" />
          <div v-else class="column is-full no-left-padding">
            <b-button type="app-primary" @click="addMode = true">Add Client</b-button>
          </div>
          <div class="column" />
          <div class="column" />
          <div class="column portlet">
            <Clients :clients="clientsList" />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Header from '@/components/global/Header'
import Clients from '@/components/clients/Clients'
import AddClient from '@/components/clients/AddClient'

export default {
  components: {
    Header,
    Clients,
    AddClient
  },
  data() {
    return {
      clientsList: [
        {
          'username': 'acemcvdlm20140285',
          'name': 'Ace Medical Center (Valenzuela)',
          'dispatch_mode': 'ONLINE',
          'created_date': '3 months ago',
          'actions': null
        },
        {
          'username': 'pathorecepqc0220',
          'name': 'ST. LUKES MEDICAL CTR. QUEZON CITY',
          'dispatch_mode': 'ONLINE',
          'created_date': '19 days ago',
          'actions': null
        }
      ],
      addMode: false
    }
  },
  methods: {
    testClick() {
      console.log('hey')
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/clients/index.scss";
</style>
