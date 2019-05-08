<template>
  <section class="processors-list">
    <h1>PROCESSORS LIST</h1>
    <hr>
    <b-field grouped>
      <b-input
        v-model="form.search"
        placeholder="Search Processor"
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
          width="300"
        >
          {{ props.row.username }}
        </b-table-column>
        <b-table-column
          field="created_at"
          label="Date Added"
          width="300"
        >
          {{ props.row.created_at | relativeTime }}
        </b-table-column>
        <b-table-column
          field="actions"
          label="Actions"
          width="300"
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
        search: null
      }
    }
  },
  computed: {
    ...mapGetters('processor', ['getLastPage'])
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
  @import "../../../sass/components/processors/list.scss";
</style>
