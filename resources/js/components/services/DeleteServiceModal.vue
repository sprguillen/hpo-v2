<template>
  <b-modal
    class="delete-modal"
    :active.sync="open"
    :can-cancel="false"
    has-modal-card
  >
    <div class="card">
      <header class="modal-card-head">
        <p class="modal-card-title">
          <b-icon icon="archive" /> Archive Service
        </p>
      </header>
      <div class="modal-card-body">
        <div class="columns">
          <div class="column">
            Are you sure you want to archive service {{ modalServiceName }}?
          </div>
        </div>
        <div class="columns">
          <div class="column">
            <div class="modal-actions">
              <b-button
                type="is-danger modal-buttons"
                @click="$emit('close')"
              >
                Cancel
              </b-button>
              <b-button
                type="is-success modal-buttons"
                @click="$emit('archive')"
              >
                Yes
              </b-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </b-modal>
</template>
<script>
export default {
  props: {
    open: {
      type: Boolean,
      required: true
    },
    modalServiceName: {
      type: String,
      required: true
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/services/deleteServiceModal.scss";
</style>
