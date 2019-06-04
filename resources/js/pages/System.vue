<template>
  <div class="system">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column portlet">
            <section>
              <h1 class="float-left">
                <b-icon icon="settings" />
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
                  <li @click="activeTab = 'Dispatchers'">
                    <a>Dispatchers</a>
                  </li>
                  <li
                    :class="isActive('Sources')"
                    @click="activeTab = 'Sources'"
                  >
                    <a>Sources</a>
                  </li>
                  <li 
                    :class="isActive('GlobalPrefix')"
                    @click="activeTab = 'GlobalPrefix'"
                  >
                    <a>Global Prefix</a>
                  </li>
                </ul>
              </div>
              <div class="clearfix" />
              <component
                :is="activeTab"
                v-bind="dynamicProps"
              />
            </section>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Header from '@/components/global/Header'
import TestAnnouncements from '@/components/system/TestAnnouncements'
import PatientTypes from '@/components/system/PatientTypes'
import Dispatchers from '@/components/system/Dispatchers'
import Sources from '@/components/system/Sources'
import GlobalPrefix from '@/components/system/GlobalPrefix'

export default {
  components: {
    Header,
    TestAnnouncements,
    PatientTypes,
    Dispatchers,
    Sources,
    GlobalPrefix
  },
  data() {
    return {
      patientTypesList: [
        {
          code: 'OP',
          name: 'SEND IN'
        }
      ],
      dispatchersList: [
        {
          code: 'C',
          name: 'ONLINE'
        },
        {
          code: '2',
          name: 'SEND'
        }
      ],
      sourcesList: [
        {
          code: '1100',
          name: 'TESTING ACCOUNT'
        },
        {
          code: '111034',
          name: 'BERNARDINO GEN. HOSP.-1'
        }
      ],
      activeTab: 'TestAnnouncements'
    }
  },
  computed: {
    dynamicProps() {
      if (this.activeTab === 'PatientTypes') {
        return { patientTypes: this.patientTypesList }
      } else if (this.activeTab === 'Sources') {
        return { sources: this.sourcesList }
      } else if (this.activeTab === 'Dispatchers') {
        return { dispatchers: this.dispatchersList }
      }

      return null
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
