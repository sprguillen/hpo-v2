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
            @success="callFetchClient"
          />
          <div
            class="column portlet"
            :class="addMode ? 'mt-4' : null"
          >
            <List
              :clients="getClients"
              :current="page"
              @next="next()"
              @prev="prev()"
              @search="search"
            />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import debounce from 'lodash.debounce'
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
      addMode: false,
      page: 1
    }
  },
  computed: {
    ...mapGetters('client', ['getClients'])
  },
  async beforeMount() {
    this.callFetchClient()
  },
  methods: {
    ...mapActions('client', ['fetchClients', 'searchClients']),
    async callFetchClient() {
      const params = {
        page: this.page
      }
      await this.fetchClients(params)
    },
    async next() {
      this.page++
      await this.callFetchClient()
    },
    async prev() {
      this.page--
      await this.callFetchClient()
    },
    search: debounce(async function(value) {
      if (value) {
        const params = {
          key: value
        }
        await this.searchClients(params)
      } else {
        await this.callFetchClient()
      }
    }, 500)
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/clients/index.scss";
</style>
