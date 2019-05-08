<template>
  <b-table
    :data="sources"
    bordered
    striped
    hoverable
  >
    <template slot-scope="props">
      <b-table-column
        field="code"
        label="Code"
      >
        {{ props.row.code }}
      </b-table-column>
      <b-table-column
        field="name"
        label="Name"
        width="1200"
      >
        {{ props.row.name }}
      </b-table-column>
      <b-table-column
        field="actions"
        label="Actions"
      >
        <b-button type="is-danger">
          Archive
        </b-button>
      </b-table-column>
    </template>
  </b-table>
</template>
<script>
export default {
  props: {
    sources: {
      type: Array,
      required: true
    }
  }
}
</script>
