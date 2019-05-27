<template>
  <b-modal
    class="edit-service-modal"
    :active.sync="open"
    has-modal-card
  >
    <div class="card custom-width">
      <div class="modal-card-body">
        <form @submit.prevent="submit">
          <div class="column">
            <h3>Update Service</h3>
            <hr>
          </div>
          <div class="column no-top-padding">
            <div class="columns">
              <div class="column">
                <b-field label="Code">
                  <b-input
                    v-model="form.code"
                    name="code"
                    placeholder="Code"
                    icon="key"
                  />
                </b-field>
              </div>
            </div>
            <div class="columns">
              <div class="column">
                <b-field label="Name">
                  <b-input
                    v-model="form.name"
                    name="name"
                    placeholder="Name"
                    icon="tag"
                  />
                </b-field>
              </div>
            </div>
            <div class="columns">
              <div class="column">
                <b-field label="Default Cost">
                  <b-input
                    v-model="form.default_cost"
                    name="default-cost"
                    placeholder="Default Cost"
                    icon="currency-usd"
                  />
                </b-field>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="modal-actions">
              <hr>
              <b-button
                class="float-right"
                type="is-danger"
                @click="$emit('close')"
              >
                Close
              </b-button>
              <b-button
                class="float-right mr-2"
                tag="input"
                type="app-primary"
                native-type="submit"
                value="Update"
              />
            </div>
          </div>
        </form>
      </div>
    </div>
  </b-modal>
</template>
<script>
import { mapActions } from 'vuex'

export default {
  props: {
    open: {
      type: Boolean,
      default: false
    },
    code: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      form: {
        code: '',
        name: '',
        default_cost: ''
      }
    }
  },
  async beforeMount() {
    const payload = {
      code: this.code
    }

    this.service = await this.fetchService(payload)
    this.form.code = this.code
    this.form.name = this.service.name
    this.form.default_cost = this.service.default_cost
  },
  methods: {
    ...mapActions('service', ['fetchService', 'updateService']),
    async submit() {
      const payload = {
        id: this.service.id,
        name: this.form.name,
        code: this.form.code,
        default_cost: this.form.default_cost
      }

      try {
        const message = await this.updateService(payload)
        this.$toast.open({
          message: message,
          type: 'is-success'
        })

        this.$emit('close')
      } catch (e) {
        this.$toast.open({
          message: `Error on updating service ${e.message}`,
          type: 'is-danger'
        })
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/services/editServiceModal.scss";
</style>
