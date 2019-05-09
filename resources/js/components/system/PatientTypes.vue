<template>
  <section class="patient-type">
    <div class="column portlet">
      <div class="header-portlet">
        <h2 class="float-left">
          PATIENT TYPES
        </h2>
        <div class="mini-form float-right">
          <form @submit.prevent="submit">
            <b-field grouped>
              <b-input
                placeholder="Code"
                size="is-small"
              />
              <b-input
                placeholder="Name"
                size="is-small"
              />
              <b-button
                size="is-small"
                tag="input"
                type="app-primary"
                native-type="submit"
              >
                Save
              </b-button>
            </b-field>
          </form>
        </div>
      </div>
      <b-table
        :data="patientTypes"
        bordered
        striped
        hoverable
      >
        <template slot-scope="props">
          <b-table-column
            field="code"
            label="Code"
            width="300"
          >
            {{ props.row.code }}
          </b-table-column>
          <b-table-column
            field="name"
            label="Name"
            width="300"
          >
            {{ props.row.name }}
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
    </div>
  </section>
</template>
<script>
export default {
  props: {
    patientTypes: {
      type: Array,
      required: true
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/system/patientTypes.scss";
</style>
