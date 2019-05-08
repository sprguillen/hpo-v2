<template>
  <b-table
    :data="services"
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
        width="700"
      >
        {{ props.row.name }}
      </b-table-column>
      <b-table-column
        field="price"
        label="Price"
        width="500"
      >
        {{ props.row.price }}
      </b-table-column>
      <b-table-column
        field="actions"
        label="Actions"
      >
        <b-button type="is-success">
          Edit Price
        </b-button>
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
    services: {
      type: Array,
      required: true
    }
  }
}
</script>
