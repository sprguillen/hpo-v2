<template>
  <section class="processors-list">
    <div class="header-portlet">
      <h1>PROCESSORS LIST</h1>
    </div>
    <b-field grouped>
      <b-input
        v-model="form.search"
        placeholder="Search Processor"
        @input="$emit('search', form.search)"
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
      <DeleteProcessorModal
        :open="open"
        :modal-username="modalUsername"
        @archive="archive"
        @close="open = false"
      />
    </div>
  </section>
</template>
<script>
import { mapGetters } from 'vuex'
import { relativeTime } from '@/filters/date'

export default {
  components: {
    DeleteProcessorModal: () => import('@/components/processors/DeleteProcessorModal')
  },
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
  @import "../../../sass/components/processors/list.scss";
</style>
