<template>
  <div class="client-details">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column is-full no-left-padding">
            <router-link to="/clients">
              <b-button
                type="is-danger"
                icon-left="keyboard-backspace"
              >
                Back
              </b-button>
            </router-link>
            <div class="column portlet mt-4">
              <section>
                <h1>CLIENT INFORMATION</h1>
                <hr>
                <b-field grouped>
                  <b-field
                    label="Client"
                    expanded
                  >
                    Test Client
                  </b-field>
                  <b-field
                    label="Date Added"
                    expanded
                  >
                    May 08, 2019
                  </b-field>
                </b-field>
                <div class="tabs is-boxed">
                  <ul>
                    <li
                      :class="isActive('Services')"
                      @click="activeTab = 'Services'"
                    >
                      <a>
                        <b-icon icon="hospital" />
                        <span>Services</span>
                      </a>
                    </li>
                    <li
                      :class="isActive('Sources')"
                      @click="activeTab = 'Sources'"
                    >
                      <a>
                        <b-icon icon="cash" />
                        <span>Sources</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <component
                  :is="activeTab"
                  v-bind="dynamicProps"
                />
              </section>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Header from '@/components/global/Header'
import Services from '@/components/clients/Services'
import Sources from '@/components/clients/Sources'

export default {
  components: {
    Header,
    Services,
    Sources
  },
  data() {
    return {
      servicesList: [
        {
          code: '24UALB',
          name: '24 Hour Urine Albumin',
          price: 'P 800'
        },
        {
          code: '24OSM9',
          name: '24 Hour Urine Osmolality',
          price: 'P 1000'
        },
        {
          code: '24UOA9',
          name: '24 Hour Urine Oxalic Acid',
          price: 'P 1200'
        }
      ],
      sourcesList: [
        {
          code: '123273',
          name: 'ACE MEDICAL CTR. (VALENZUELA)'
        }
      ],
      activeTab: 'Services'
    }
  },
  computed: {
    dynamicProps() {
      if (this.activeTab === 'Services') {
        return {services: this.servicesList }
      } else {
        return { sources: this.sourcesList }
      }
    }
  },
  methods: {
    isActive(currentComponent) {
      if (this.activeTab === currentComponent) {
        return 'details-active'
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/clients/details.scss";
</style>
