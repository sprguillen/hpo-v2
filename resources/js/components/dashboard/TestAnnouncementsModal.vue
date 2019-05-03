<template>
  <b-modal
    class="announcements-modal"
    :active.sync="open"
    has-modal-card
  >
    <div class="card">
      <header class="modal-card-head">
        <p class="modal-card-title">
          <b-icon icon="alert-circle" /> Batch Order Summary
        </p>
      </header>
      <div class="modal-card-body">
        <div class="columns">
          <div class="column">
            <h3>Test/Services Announcements</h3>
            <div class="column is-mobile">
              <div class="column">
                Topic:
              </div>
              <div class="column">
                {{ announcement.topic }}
              </div>
            </div>
            <div class="column">
              <div class="column">
                Content:
              </div>
              <div class="column">
                Test Content
              </div>
            </div>
            <div class="column">
              <div class="column">
                Availability from:
              </div>
              <div class="column">
                {{ getCurrentDate }}
              </div>
            </div>
            <div class="column">
              <div class="column">
                Availability to:
              </div>
              <div class="column">
                {{ getCurrentDate }}
              </div>
            </div>
          </div>
        </div>
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
import moment from 'moment'

export default {
  props: {
    open: {
      type: Boolean,
      default: false
    },
    announcement: {
      type: Object,
      required: true
    }
  },
  computed: {
    getCurrentDate() {
      return moment().format('L')
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/dashboard/testAnnouncementsModal.scss";
</style>
