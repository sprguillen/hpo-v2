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
              @update="update"
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
      file: null,
      fetchBySearch: false,
      searchVal: ''
    }
  },
  computed: {
    ...mapGetters('service', ['getServices'])
  },
  async beforeMount() {
    this.callFetchServices()
  },
  methods: {
    ...mapActions('service', [
      'fetchServices',
      'searchServices',
      'archiveService',
      'importService',
      'updateService'
    ]),
    async callFetchServices() {
      const payload = {
        page: this.page
      }

      if (this.fetchBySearch && this.searchVal) {
        payload.key = this.searchVal
        await this.searchServices(payload)
      } else {
        await this.fetchServices(payload)
      }
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
        this.fetchBySearch = true
        this.searchVal = value
        await this.callFetchServices()
      } else {
        this.fetchBySearch = false
        this.searchVal = ''
        await this.callFetchServices()
      }
    }, 500),
    async importFile() {
      let formData = new FormData();
      formData.append('file', this.file)
      try {
        await this.importService(formData)
        this.$toast.open({
          message: 'Import successful',
          type: 'is-success'
        })
        await this.callFetchServices()
      } catch (e) {
        console.error(e)
      }
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
    },
    async update(payload) {
      try {
        const message = await this.updateService(payload)
        this.$toast.open({
          message: message,
          type: 'is-success'
        })

        await this.callFetchServices()
      } catch (e) {
        this.$toast.open({
          message: `Error on updating service ${e.message}`,
          type: 'is-danger'
        })
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/services/index.scss";
</style>
