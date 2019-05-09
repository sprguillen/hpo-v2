<template>
  <div class="system">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column portlet">
            <section>
              <h1 class="float-left">
                SYSTEM CONFIGURATIONS
              </h1>
              <div class="tabs float-right">
                <ul>
                  <li
                    :class="isActive('TestAnnouncements')"
                    @click="activeTab = 'TestAnnouncements'"
                  >
                    <a>Test Announcements</a>
                  </li>
                  <li
                    :class="isActive('PatientTypes')"
                    @click="activeTab = 'PatientTypes'"
                  >
                    <a>Patient Types</a>
                  </li>
                  <li @click="activeTab = 'dispatchers'">
                    <a>Dispatchers</a>
                  </li>
                  <li @click="activeTab = 'sources'">
                    <a>Sources</a>
                  </li>
                  <li @click="activeTab = 'globalPrefix'">
                    <a>Global Prefix</a>
                  </li>
                </ul>
              </div>
              <div class="clearfix" />
            </section>
            <component :is="activeTab" />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Header from '@/components/global/Header'
import TestAnnouncements from '@/components/system/TestAnnouncements'

export default {
  components: {
    Header,
    TestAnnouncements
  },
  data() {
    return {
      activeTab: 'TestAnnouncements'
    }
  },
  methods: {
    isActive(currentComponent) {
      if (this.activeTab === currentComponent) {
        return 'system-active'
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../sass/pages/system.scss";
</style>
