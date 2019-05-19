<template>
  <div class="services">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column is-full no-left-padding">
            <b-button
              v-if="!addMode"
              type="app-primary"
              icon-right="plus"
              @click="addMode = true"
            >
              Add a Service
            </b-button>
            <b-button
              type="app-primary"
              icon-right="cloud-download"
              @click="importFile"
            >
              Import
            </b-button>
          </div>
          <AddService
            v-if="addMode"
            @hide="addMode = false"
            @success="callFetchServices"
          />
          <div class="column" />
          <div class="column" />
          <div class="column portlet">
            <List
              :services="getServices"
              :current="page"
              @next="next()"
              @prev="prev()"
            />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
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
      addMode: false,
      page: 1
    }
  },
  computed: {
    ...mapGetters('service', ['getServices'])
  },
  async beforeMount() {
    this.callFetchServices()
  },
  methods: {
    ...mapActions('service', ['fetchServices']),
    async callFetchServices() {
      const payload = {
        page: this.page
      }
      await this.fetchServices(payload)
    },
    async next() {
      this.page++
      await this.callFetchServices()
    },
    async prev() {
      this.page--
      await this.callFetchServices()
    },
    importFile() {

    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/services/index.scss";
</style>
