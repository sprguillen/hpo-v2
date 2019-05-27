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
            <b-upload
              v-model="file"
              :native="true"
              @input="importFile"
            >
              <a class="button app-primary">
                <b-icon icon="cloud-download" />
                <span>Import</span>
              </a>
            </b-upload>
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
      page: 1,
      file: null
    }
  },
  computed: {
    ...mapGetters('service', ['getServices'])
  },
  async beforeMount() {
    this.callFetchServices()
  },
  methods: {
    ...mapActions('service', ['fetchServices', 'searchServices', 'archiveService']),
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
    search: debounce(async function(value) {
      if (value) {
        const payload = {
          key: value
        }
        await this.searchServices(payload)
      } else {
        await this.callFetchServices()
      }
    }, 500),
    importFile() {
      console.log(this.file)
    },
    async archive(value) {
      const payload = {
        id: value
      }

      try {
        await this.archiveService(payload)
        this.$toast.open({
          message: 'Service was successfully archived',
          type: 'is-success'
        })
        await this.callFetchServices()
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
  @import "../../../sass/pages/services/index.scss";
</style>
