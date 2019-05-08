<template>
  <div class="processors">
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
              Add Processor
            </b-button>
          </div>
          <AddProcessor
            v-if="addMode"
            @hide="addMode = false"
            @success="callFetchProcessor"
          />
          <div
            class="column portlet"
            :class="addMode ? 'mt-4' : null"
          >
            <List
              :processors="getProcessors"
              :current="page"
              @next="next"
              @prev="prev"
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
import List from '@/components/processors/List'
import AddProcessor from '@/components/processors/AddProcessor'

export default {
  components: {
    Header,
    List,
    AddProcessor
  },
  data() {
    return {
      addMode: false,
      page: 1
    }
  },
  computed: {
    ...mapGetters('processor', ['getProcessors'])
  },
  async beforeMount() {
    this.callFetchProcessor()
  },
  methods: {
    ...mapActions('processor', ['fetchProcessors']),
    async callFetchProcessor() {
      const params = {
        page: this.page
      }
      await this.fetchProcessors(params)
    },
    async next() {
      this.page++
      await this.callFetchProcessor()
    },
    async prev() {
      this.page--
      await this.callFetchProcessor()
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../sass/pages/processors.scss";
</style>
