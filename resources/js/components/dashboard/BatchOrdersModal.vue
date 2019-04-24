<template>
  <b-modal class="batch-modal" :active.sync="open" has-modal-card>
    <div class="card">
      <header class="modal-card-head">
         <p class="modal-card-title">
          <b-icon icon="format-list-bulleted"></b-icon> Batch Order Summary
         </p>
      </header>
      <div class="modal-card-body">
        <h3>Batch Order Information</h3>
        <b-table :data="details" bordered striped narrowed hoverable>
          <template slot-scope="props">
            <b-table-column field="batchNo" label="Batch no." numeric>
              {{ props.row.batchNo }}
            </b-table-column>
            <b-table-column field="numberOfTests" label="No. of tests">
              {{ props.row.numberOfTests }}
            </b-table-column>
            <b-table-column field="numberOfPatients" label="No. of patients">
              {{ props.row.numberOfPatients }}
            </b-table-column>
            <b-table-column field="totalCost" label="Total Cost">
              P{{ props.row.totalCost }}
            </b-table-column>
            <b-table-column field="clinician" label="Clinician">
              Test
            </b-table-column>
            <b-table-column field="patientType" label="Patient Type">
            </b-table-column>
            <b-table-column field="paymentMode" label="Payment Mode">
            </b-table-column>
            <b-table-column field="tagMode" label="Tag Mode">
            </b-table-column>
            <b-table-column field="status" label="Status">
              {{ props.row.status }}
            </b-table-column>
          </template>
        </b-table>
      </div>
      <footer class="modal-card-foot">
        <div class="modal-actions">
          <b-button type="is-danger close-button" @click="$emit('close')">Close</b-button>
        </div>
      </footer>
    </div>
  </b-modal>
</template>
<script>
export default {
  props: {
    open: {
      type: Boolean,
      default: false
    },
    details: {
      type: Array,
      default: []
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/dashboard/batchOrdersModal.scss";
</style>
