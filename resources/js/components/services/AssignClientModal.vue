<template>
  <b-modal
    class="assign-modal"
    :active.sync="open"
    has-modal-card
  >
    <div class="card">
      <header class="modal-card-head">
        <p class="modal-card-title">
          ASSIGN SERVICE TO CLIENT
        </p>
      </header>
      <div class="modal-card-body">
        <form
          class="assign-form"
          @submit.prevent="submit"
        >
          <b-field label="Name">
            <v-select
              :filterable="false"
              :options="options"
              @search="searchClient"
            >
              <template slot="no-options">
                Type to search for an existing client.
              </template>
              <template
                slot="option"
                slot-scope="option"
              >
                {{ `${option.first_name} ${option.last_name}` }}
              </template>
              <template
                slot="selected-option"
                slot-scope="option"
              >
                {{ `${option.first_name} ${option.last_name}` }}
              </template>
            </v-select>
          </b-field>
          <b-field>
            <b-input
              v-model="form.price"
              placeholder="Number"
              type="number"
            />
          </b-field>
          <b-button
            type="app-primary"
            tag="input"
            native-type="submit"
            value="Save"
          />
        </form>
      </div>
    </div>
  </b-modal>
</template>
<script>
import { mapActions } from 'vuex'
import debounce from 'lodash.debounce'

export default {
  props: {
    open: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      form: {
        client: null,
        price: 0
      },
      options: []
    }
  },
  methods: {
    ...mapActions('client', ['searchClients']),
    submit() {

    },
    searchClient: debounce(async function(search, loading) {
      if (search) {
        loading(true)
        const payload = {
          key: search
        }
        const { clients } = await this.searchClients(payload)
        this.options = clients.data
        loading(false)
      }
    }, 500)
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/services/assignClientModal.scss";
</style>
