<template>
  <section class="test-announcements">
    <div class="columns is-full">
      <h4>TEST/SERVICE ANNOUNCEMENTS</h4>
    </div>
    <div class="columns-is-full">
      <div v-for="(line, index) in splitAnnouncements" :key="index" class="columns">
        <div v-for="announcement in line"
          :key="announcement.topic"
          class="column is-one-quarter">
          <div class="topic" @click="openAnnouncementModal(announcement)">
            <span>{{ announcement.topic }}</span>
          </div>
        </div>
      </div>
    </div>
    <TestAnnouncementsModal
      :open="isModalActive"
      :announcement="currentAnnouncement"
      @close="isModalActive = false" />
  </section>
</template>
<script>
import TestAnnouncementsModal from '@/components/dashboard/TestAnnouncementsModal'

export default {
  components: {
    TestAnnouncementsModal
  },
  props: {
    announcements: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      isModalActive: false,
      currentAnnouncement: {}
    }
  },
  computed: {
    splitAnnouncements() {
      let announcements = []
      let line = []
      for (let i = 4; i < this.announcements.length + 4; i += 4) {
        for (let j = i - 4; j < i; j++) {
          if (this.announcements[j]) {
            line.push(this.announcements[j])
          }
        }

        if (line.length > 0) {
          announcements.push(line)
          line = []
        }
      }

      return announcements
    }
  },
  methods: {
    openAnnouncementModal(announcement) {
      this.currentAnnouncement = announcement
      this.isModalActive = true
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/dashboard/testAnnouncements.scss";
</style>
