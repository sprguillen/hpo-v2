<template>
  <section class="test-announcements">
    <div class="columns is-full">
      <h4>TEST/SERVICE ANNOUNCEMENTS</h4>
    </div>
    <div class="columns-is-full">
      <div class="columns">
        <div v-for="announcement in announcements"
          :key="announcement.topic"
          class="column is-one-quarter">
          <div class="topic">
            <span>{{ announcement.topic }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  props: {
    announcements: {
      type: Array,
      required: true
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/dashboard/testAnnouncements.scss";
</style>
