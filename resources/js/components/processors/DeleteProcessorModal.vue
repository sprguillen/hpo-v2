<template>
  <b-modal
    class="delete-modal"
    :active.sync="open"
    has-modal-card
  >
    <div class="card">
      <header class="modal-card-head">
        <p class="modal-card-title">
          <b-icon icon="archive" /> Archive Processor
        </p>
      </header>
      <div class="modal-card-body">
        <div class="columns">
          <div class="column">
            Are you sure you want to archive processor {{ modalUsername }}?
          </div>
        </div>
        <div class="columns">
          <div class="column">
            <div class="modal-actions">
              <b-button
                class="float-right"
                type="is-danger modal-buttons"
                @click="$emit('close')"
              >
                Cancel
              </b-button>
              <b-button
                class="float-right mr-2"
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
    modalUsername: {
      type: String,
      required: true
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/processors/deleteProcessorModal.scss";
</style>
