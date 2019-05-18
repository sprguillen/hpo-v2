<template>
  <b-modal
    class="assign-modal"
    :active.sync="open"
    has-modal-card
  >
    <div class="card">
      <header class="modal-card-head">
        <p class="modal-card-title">
          Assign a Service
        </p>
      </header>
      <div class="modal-card-body">
        <b-table
          :data="services"
          bordered
          striped
          narrowed
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
              field="status"
              label="Status"
            >
              Unassigned
            </b-table-column>
            <b-table-column
              field="actions"
              label="Actions"
            >
              <b-button
                type="app-primary"
              >
                Assign
              </b-button>
            </b-table-column>
          </template>
        </b-table>
      </div>
      <footer class="modal-card-foot">
        <div class="modal-actions">
          <b-button
            type="is-danger close-button"
            @click="$emit('close')"
          >
            Close
          </b-button>
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
      required: true
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/clients/services.scss";
</style>
