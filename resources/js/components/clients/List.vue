<template>
  <section class="clients-list">
    <h1>CLIENTS LIST</h1>
    <hr>
    <b-field grouped>
      <b-input
        v-model="form.search"
        placeholder="Search Client"
        @input="search()"
      />
    </b-field>
    <b-table
      :data="clients"
      bordered
      striped
      hoverable
    >
      <template slot-scope="props">
        <b-table-column
          field="username"
          label="Client"
        >
          <router-link
            :to="{ name: 'client_details', params: { id: props.row.id } }"
            class="client-link"
          >
            {{ props.row.username }}
          </router-link>
        </b-table-column>
        <b-table-column
          field="name"
          label="Name"
          width="700"
        >
          {{ props.row.first_name }} {{ props.row.last_name }}
        </b-table-column>
        <b-table-column
          field="created_at"
          label="Date Added"
        >
          {{ props.row.created_at }}
        </b-table-column>
        <b-table-column
          field="actions"
          label="Actions"
        >
          <b-button type="is-success">
            Send reset password
          </b-button>
          <b-button type="is-danger">
            Archive
          </b-button>
        </b-table-column>
      </template>
    </b-table>
    <div class="pagination-controls mt-2">
      <b-button
        type="is-danger"
        :disabled="current === 1"
        @click="prev()"
      >
        Previous
      </b-button>
      <b-button
        type="is-danger"
        :disabled="current === getLastPage"
        @click="next()"
      >
        Next
      </b-button>
    </div>
  </section>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  props: {
    clients: {
      type: Array,
      required: true
    },
    current: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      form: {
        search: null
      }
    }
  },
  computed: {
    ...mapGetters('client', ['getLastPage'])
  },
  methods: {
    next() {
      this.$emit('next')
    },
    prev() {
      this.$emit('prev')
    },
    search() {
      this.$emit('search', this.form.search)
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/clients/list.scss";
</style>
