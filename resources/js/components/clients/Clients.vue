<template>
  <section class="clients-list">
    <h1>CLIENTS LIST</h1>
    <hr />
    <b-field grouped>
      <b-input v-model="form.search" placeholder="Search Client"></b-input>
    </b-field>
    <b-table :data="clients">
      <template slot-scope="props">
        <b-table-column field="username" label="Client">
          <router-link :to="{ name: 'client_details', params: { id: 'test' } }"  class="client-link">{{ props.row.username }}</router-link>
        </b-table-column>
        <b-table-column field="name" label="Name" width="700">
          {{ props.row.name }}
        </b-table-column>
        <b-table-column field="dispatch_mode" label="Dispatch Mode">
          {{ props.row.dispatch_mode }}
        </b-table-column>
        <b-table-column field="created_date" label="Date Added">
          {{ props.row.created_date }}
        </b-table-column>
        <b-table-column field="actions" label="Actions">
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
    clients: {
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
  @import "../../../sass/components/clients/clients.scss";
</style>
