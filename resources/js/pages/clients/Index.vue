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
              @archive="archive"
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
    ...mapActions('client', ['fetchClients', 'searchClients', 'archiveClient']),
    async callFetchClient() {
      const payload = {
        page: this.page
      }
      await this.fetchClients(payload)
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
        const payload = {
          key: value
        }
        await this.searchClients(payload)
      } else {
        await this.callFetchClient()
      }
    }, 500),
    async archive(value) {
      const payload = {
        id: value
      }

      try {
        await this.archiveClient(payload)
        this.$toast.open({
          message: 'Client was successfully archived',
          type: 'is-success'
        })
        await this.callFetchClient()
      } catch (e) {
        this.$toast.open({
          message: e.message,
          type: 'is-success'
        })
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/clients/index.scss";
</style>
