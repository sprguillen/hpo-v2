<template>
  <section class="batch-order-summary">
    <div class="columns">
      <div class="column is-half">
        <span class="number-of-orders">2</span>
        <span class="order-type">{{ type }} Batch Orders</span>
      </div>
      <div class="column is-half">
        <b-pagination
          :total="orders.length"
          :order="'is-right'"
          per-page="5"
          size="is-small"
          simple
        />
      </div>
    </div>
    <b-table
      :data="orders"
      bordered
      striped
      narrowed
      hoverable
    >
      <template slot-scope="props">
        <b-table-column
          field="batchNo"
          label="Batch no."
          numeric
        >
          {{ props.row.batchNo }}
        </b-table-column>
        <b-table-column
          field="numberOfTests"
          label="No. of tests"
        >
          {{ props.row.numberOfTests }}
        </b-table-column>
        <b-table-column
          field="numberOfPatients"
          label="No. of patients"
        >
          {{ props.row.numberOfPatients }}
        </b-table-column>
        <b-table-column
          field="totalCost"
          label="Total Cost"
        >
          P{{ props.row.totalCost }}
        </b-table-column>
        <b-table-column
          field="status"
          label="Status"
        >
          {{ props.row.status }}
        </b-table-column>
        <b-table-column
          field="actions"
          label="Actions"
        >
          <b-button
            type="is-success"
            @click="openBatchModal(props.row)"
          >
            View
          </b-button>
        </b-table-column>
      </template>
    </b-table>
    <BatchOrdersModal
      :open="isModalActive"
      :details="currentOrder"
      @close="isModalActive = false"
    />
  </section>
</template>
<script>
import BatchOrdersModal from '@/components/dashboard/BatchOrdersModal'

export default {
  components: {
    BatchOrdersModal
  },
  props: {
    orders: {
      type: Array,
      required: true
    },
    type: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      isModalActive: false,
      currentOrder: []
    }
  },
  methods: {
    openBatchModal(batch) {
      this.currentOrder = [batch]
      this.isModalActive = true
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/dashboard/batchOrders.scss";
</style>
