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
          </div>
          <div class="column">
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
export default {
  props: {
    open: {
      type: Boolean,
      default: false
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
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/services/editServiceModal.scss";
</style>
