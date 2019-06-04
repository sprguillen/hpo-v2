<template>
  <section class="clients-list">
    <div class="header-portlet">
      <h1>CLIENTS LIST</h1>
    </div>
    <b-field grouped>
      <b-input
        v-model="form.search"
        placeholder="Search Client"
        @input="$emit('search', form.search)"
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
            :to="{ name: 'client_details', params: { code: props.row.code } }"
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
          {{ props.row.created_at | relativeTime }}
        </b-table-column>
        <b-table-column
          field="actions"
          label="Actions"
        >
          <b-button type="is-success">
            Send Reset Password
          </b-button>
          <b-button
            type="is-danger"
            @click="openDeleteModal(props.row.id, props.row.username)"
          >
            Archive
          </b-button>
        </b-table-column>
      </template>
    </b-table>
    <div class="pagination-controls mt-2">
      <b-button
        type="is-danger"
        :disabled="current === 1"
        @click="$emit('prev')"
      >
        Previous
      </b-button>
      <b-button
        type="is-danger"
        :disabled="current === getLastPage"
        @click="$emit('next')"
      >
        Next
      </b-button>
    </div>
    <DeleteClientModal
      :open="open"
      :modal-username="modalUsername"
      @archive="archive"
      @close="open = false"
    />
  </section>
</template>
<script>
import { mapGetters } from 'vuex'
import { relativeTime } from '@/filters/date'

export default {
  components: {
    DeleteClientModal: () => import('@/components/clients/DeleteClientModal')
  },
  filters: {
    relativeTime
  },
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
        search: ''
      },
      open: false,
      userToArchive: '',
      modalUsername: ''
    }
  },
  computed: {
    ...mapGetters('client', ['getLastPage'])
  },
  methods: {
    openDeleteModal(id, username) {
      this.userToArchive = id
      this.modalUsername = username
      this.open = true
    },
    archive() {
      this.$emit('archive', this.userToArchive)
      this.open = false
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/clients/list.scss";
</style>
