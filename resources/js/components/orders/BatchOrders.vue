<template>
  <section class="batch-orders">
    <div class="column">
      <div class="header-portlet">
        <div>
          <form @submit.prevent="submit">
            <b-field>
              <p class="control">
                <span class="button is-static">
                  65800
                </span>
              </p>
              <b-input
                expanded
                placeholder="Search Batch by Number (You may enter the last four numbers only"
              />
            </b-field>
          </form>
        </div>
      </div>
      <b-table
        :data="batchOrders"
        bordered
        striped
        hoverable
      >
        <template slot-scope="props">
          <b-table-column
            field="batchNo"
            label="Batch no."
            width=""
          >
            {{ props.row.batchNo }}
          </b-table-column>
          <b-table-column
            field="tests"
            label="No. of tests"
            width=""
          >
            {{ props.row.tests }}
          </b-table-column>
          <b-table-column
            field="patients"
            label="No. of patients"
            width=""
          >
            {{ props.row.patients }}
          </b-table-column>
          <b-table-column
            field="totalCost"
            label="Total Cost"
            width=""
          >
            {{ props.row.totalCost }}
          </b-table-column>
          <b-table-column
            field="status"
            label="Status"
            width=""
          >
            {{ props.row.status }}
          </b-table-column>
          <b-table-column
            field="dateCreated"
            label="Date Created"
            width=""
          >
            {{ props.row.dateCreated }}
          </b-table-column>
          <b-table-column
            field="actions"
            label="Actions"
            width="300"
          >
            <b-button type="app-primary">
              Done
            </b-button>
            <b-button type="is-success">
              View PDF
            </b-button>
          </b-table-column>
        </template>
      </b-table>
    </div>
  </section>
</template>
<script>
export default {
  props: {
    batchOrders: {
      type: Array,
      required: true
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/orders/batchOrders.scss";
</style>
