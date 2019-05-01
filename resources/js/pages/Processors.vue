<template>
  <div class="processors">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column is-full no-left-padding">
            <b-button v-if="!addMode" type="app-primary" @click="addMode = true" icon-right="plus">Add Processor</b-button>
          </div>
          <AddProcessor v-if="addMode" @hide="addMode = false" />
          <div class="column" />
          <div class="column" />
          <div class="column portlet">
            <List :processors="processorsList" />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
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
      processorsList: [
        {
          'username': 'marylizatibre8146',
          'created_date': '3 months ago'
        },
        {
          'username': 'tinzpineda6713',
          'created_date': '19 days ago'
        }
      ],
      addMode: false
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../sass/pages/processors.scss";
</style>
