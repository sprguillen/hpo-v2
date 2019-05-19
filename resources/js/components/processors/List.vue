<template>
  <section class="processors-list">
    <div class="header-portlet">
      <h1>PROCESSORS LIST</h1>
    </div>
    <b-field grouped>
      <b-input
        v-model="form.search"
        placeholder="Search Processor"
        @input="search()"
      />
    </b-field>
    <b-table
      :data="processors"
      bordered
      striped
      hoverable
    >
      <template slot-scope="props">
        <b-table-column
          field="username"
          label="Processor"
        >
          {{ props.row.username }}
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
    <b-modal
      class="delete-modal"
      :active.sync="open"
      has-modal-card
    >
      <div class="card">
        <header class="modal-card-head">
          <p class="modal-card-title">
            <b-icon icon="archive" /> Archive Processor
          </p>
        </header>
        <div class="modal-card-body">
          Are you sure you want to archive processor {{ modalUsername }}?
        </div>
        <footer class="modal-card-foot">
          <div class="modal-actions">
            <b-button
              type="is-danger modal-buttons"
              @click="closeModal"
            >
              Cancel
            </b-button>
            <b-button
              type="is-success modal-buttons"
              @click="archive"
            >
              Yes
            </b-button>
          </div>
        </footer>
      </div>
    </b-modal>
  </section>
</template>
<script>
import { mapGetters } from 'vuex'
import { relativeTime } from '@/filters/date'

export default {
  filters: {
    relativeTime
  },
  props: {
    processors: {
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
    ...mapGetters('processor', ['getLastPage'])
  },
  methods: {
    search() {
      this.$emit('search', this.form.search)
    },
    openDeleteModal(id, username) {
      this.userToArchive = id
      this.modalUsername = username
      this.open = true
    },
    closeModal() {
      this.open = false
      this.clear()
    },
    archive() {
      this.$emit('archive', this.userToArchive)
      this.open = false
      this.clear()
    },
    clear() {
      this.userToArchive = ''
      this.modalUsername = ''
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/processors/list.scss";
</style>
