<template>
  <section class="services-list">
    <div class="header-portlet">
      <h1>SERVICES LIST</h1>
    </div>
    <b-field grouped>
      <b-select
        v-model="form.filter"
        placeholder="No source"
      >
        <option
          v-for="option in options"
          :key="option.value"
          :value="option.value"
        >
          {{ option.text }}
        </option>
      </b-select>
      <b-input
        v-model="form.search"
        placeholder="Search Processor"
      />
    </b-field>
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
          <router-link
            :to="{ name: 'service_details', params: { id: 'test' } }"
            class="service-link"
          >
            {{ props.row.code }}
          </router-link>
        </b-table-column>
        <b-table-column
          field="name"
          label="Name"
          width="700"
        >
          {{ props.row.name }}
        </b-table-column>
        <b-table-column
          field="default_cost"
          label="Default cost"
        >
          {{ props.row.default_cost }}
        </b-table-column>
        <b-table-column
          field="no_clients"
          label="No. of clients"
          width="110"
        >
          {{ props.row.no_clients }}
        </b-table-column>
        <b-table-column
          field="no_orders"
          label="No. of orders"
          width="100"
        >
          {{ props.row.no_orders }}
        </b-table-column>
        <b-table-column
          field="actions"
          label="Actions"
        >
          <b-button type="app-primary">
            Edit
          </b-button>
          <b-button type="is-danger">
            Archive
          </b-button>
        </b-table-column>
      </template>
    </b-table>
  </section>
</template>
<script>
export default {
  props: {
    services: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      form: {
        search: null,
        filter: null
      },
      options: [
        { value: 0, text: 'HMI Care Inc.' },
        { value: 1, text: 'Dr. Jose Reyes Memorial Hospital' },
        { value: 2, text: 'National Children Hospital' }
      ]
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/services/list.scss";
</style>
