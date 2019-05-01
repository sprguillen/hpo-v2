<template>
  <section class="processors-list">
    <h1>PROCESSORS LIST</h1>
    <hr />
    <b-field grouped>
      <b-input v-model="form.search" placeholder="Search Processor"></b-input>
    </b-field>
    <b-table :data="processors" bordered striped hoverable>
      <template slot-scope="props">
        <b-table-column field="username" label="Client" width="300">
          {{ props.row.username }}
        </b-table-column>
        <b-table-column field="created_date" label="Date Added" width="300">
          {{ props.row.created_date }}
        </b-table-column>
        <b-table-column field="actions" label="Actions" width="300">
          <b-button type="is-success">Send reset password</b-button>
          <b-button type="is-danger">Archive</b-button>
        </b-table-column>
      </template>
    </b-table>
  </section>
</template>
<script>
export default {
  props: {
    processors: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      form: {
        search: null
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/processors/list.scss";
</style>
