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
        placeholder="Search Services"
        @input="$emit('search', form.search)"
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
            :to="{ name: 'service_details', params: { code: props.row.code } }"
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
          {{ getClientsCount(props.row.no_clients) }}
        </b-table-column>
        <b-table-column
          field="no_orders"
          label="No. of orders"
          width="100"
        >
          {{ getOrdersCount(props.row.no_orders) }}
        </b-table-column>
        <b-table-column
          field="actions"
          label="Actions"
        >
          <b-button
            type="app-primary"
            @click="openEditModal(props.row.code)"
          >
            Edit
          </b-button>
          <b-button
            type="is-danger"
            @click="openDeleteModal(props.row.id, props.row.name)"
          >
            Archive
          </b-button>
        </b-table-column>
      </template>
    </b-table>
    <div class="pagination-controls mt-2">
      <b-button
        type="is-danger"
        :disabled="current === 1"
        @click="$emit('prev')"
      >
        Previous
      </b-button>
      <b-button
        type="is-danger"
        :disabled="current === getLastPage"
        @click="$emit('next')"
      >
        Next
      </b-button>
    </div>
    <EditServiceModal
      v-if="open"
      :code="serviceToEdit"
      :open="open"
      @close="open = false"
      @update="update"
    />
    <DeleteServiceModal
      :open="openDelete"
      :modal-service-name="modalServiceName"
      @archive="archive"
      @close="openDelete = false"
    />
  </section>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  components: {
    EditServiceModal: () => import('@/components/services/EditServiceModal'),
    DeleteServiceModal: () => import('@/components/services/DeleteServiceModal')
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
      form: {
        search: '',
        filter: ''
      },
      options: [
        { value: 0, text: 'HMI Care Inc.' },
        { value: 1, text: 'Dr. Jose Reyes Memorial Hospital' },
        { value: 2, text: 'National Children Hospital' }
      ],
      open: false,
      serviceToEdit: '',
      serviceToArchive: '',
      modalServiceName: '',
      openDelete: false
    }
  },
  computed: {
    ...mapGetters('service', ['getLastPage'])
  },
  methods: {
    getClientsCount(clientsCount) {
      if (clientsCount > 0) {
        // fill this up later
      } else {
        return 0
      }
    },
    getOrdersCount(ordersCount) {
      if (ordersCount > 0) {
        // fill this up later
      } else {
        return 0
      }
    },
    openEditModal(code) {
      this.open = true
      this.serviceToEdit = code
    },
    openDeleteModal(id, serviceName) {
      this.serviceToArchive = id
      this.modalServiceName = serviceName
      this.openDelete = true
    },
    archive() {
      this.$emit('archive', this.serviceToArchive)
      this.openDelete = false
    },
    update(payload) {
      this.open = false
      this.$emit('update', payload)
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/services/list.scss";
</style>
