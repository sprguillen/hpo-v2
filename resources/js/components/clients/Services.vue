<template>
  <div class="client-services-list">
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
    <b-button
      class="mt-2"
      type="app-primary"
      icon-right="check"
      @click="openAssignModal = true"
    >
      Assign Service
    </b-button>
    <AssignServices :open="openAssignModal" />
    <div class="column no-left-padding">
      <h2 class="h2-portlet">
        PAYMENT MODE
      </h2>
      <b-field
        class="mt-2"
        grouped
      >
        <b-select placeholder="Select payment mode">
          <option>Cash</option>
          <option>Charge</option>
        </b-select>
        <b-button
          tag="input"
          type="app-primary"
          value="Update"
        />
      </b-field>
      <h2 class="h2-portlet">
        DISPATCH MODE
      </h2>
      <b-field
        class="mt-2"
        grouped
      >
        <b-select placeholder="Select payment mode">
          <option>Online</option>
          <option>Send</option>
        </b-select>
        <b-button
          tag="input"
          type="app-primary"
          value="Update"
        />
      </b-field>
    </div>
  </div>
</template>
<script>
import AssignServices from '@/components/clients/AssignServices'

export default {
  components: {
    AssignServices
  },
  props: {
    services: {
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
      openAssignModal: false
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/clients/services.scss";
</style>
