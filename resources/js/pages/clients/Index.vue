<template>
  <div class="clients">
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
              Add Client
            </b-button>
          </div>
          <AddClient
            v-if="addMode"
            @hide="addMode = false"
          />
          <div class="column portlet">
            <List
              :clients="getClients"
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
import List from '@/components/clients/List'
import AddClient from '@/components/clients/AddClient'

export default {
  components: {
    Header,
    List,
    AddClient
  },
  data() {
    return {
      clientsList: [],
      addMode: false,
      page: 1
    }
  },
  computed: {
    ...mapGetters('client', ['getClients'])
  },
  async beforeMount() {
    this.callGetClient()
  },
  methods: {
    ...mapActions('client', ['getClient']),
    async callGetClient() {
      const params = {
        page: this.page
      }
      await this.getClient(params)
    },
    async next() {
      this.page++
      this.callGetClient()
    },
    async prev() {
      console.log('prev')
      this.page--
      this.callGetClient()
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/clients/index.scss";
</style>
