<template>
  <b-modal
    class="delete-modal"
    :active.sync="open"
    has-modal-card
  >
    <div class="card">
      <header class="modal-card-head">
        <p class="modal-card-title">
          <b-icon icon="archive" /> Archive Client
        </p>
      </header>
      <div class="modal-card-body">
        Are you sure you want to archive client {{ modalUsername }}?
      </div>
      <footer class="modal-card-foot">
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
    },
    modalUsername: {
      type: String,
      required: true
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/clients/deleteClientModal.scss";
</style>
