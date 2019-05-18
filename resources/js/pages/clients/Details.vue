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
              <section v-if="client">
                <h1>CLIENT INFORMATION</h1>
                <hr>
                <b-field grouped>
                  <b-field
                    label="Client"
                    expanded
                  >
                    {{ client.full_name }}
                  </b-field>
                  <b-field
                    label="Date Added"
                    expanded
                  >
                    {{ client.created_at }}
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
                <div class="column no-left-padding">
                  <h2 class="h2-portlet">
                    PAYMENT MODE
                  </h2>
                  <b-field
                    class="mt-2"
                    grouped
                  >
                    <b-select
                      v-model="form.paymentMode"
                      placeholder="Select payment mode"
                    >
                      <option value="0">
                        Cash
                      </option>
                      <option value="1">
                        Charge
                      </option>
                    </b-select>
                    <b-button
                      tag="input"
                      type="app-primary"
                      value="Update"
                      @click="updateClientPayment"
                    />
                  </b-field>
                  <h2 class="h2-portlet">
                    DISPATCH MODE
                  </h2>
                  <b-field
                    class="mt-2"
                    grouped
                  >
                    <b-select
                      v-model="form.dispatchMode"
                      placeholder="Select dispatch mode"
                    >
                      <option>
                        Online
                      </option>
                      <option>
                        Send
                      </option>
                    </b-select>
                    <b-button
                      tag="input"
                      type="app-primary"
                      value="Update"
                    />
                  </b-field>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import { mapActions } from 'vuex'
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
      activeTab: 'Services',
      servicesPage: 1,
      sourcesPage: 1,
      client: null,
      form: {
        dispatchMode: null,
        paymentMode: null
      }
    }
  },
  computed: {
    dynamicProps() {
      if (this.activeTab === 'Services') {
        return {
          services: this.servicesList,
          current: this.servicesPage,
          code: this.$route.params.code
        }
      } else {
        return { sources: this.sourcesList, current: this.sourcesPage }
      }
    }
  },
  async beforeMount() {
    const payload = {
      code: this.$route.params.code
    }

    this.client = await this.fetchClient(payload)
    this.form.paymentMode = this.client.payment_mode
  },
  methods: {
    ...mapActions('client', ['fetchClient', 'updatePayment']),
    isActive(currentComponent) {
      if (this.activeTab === currentComponent) {
        return 'details-active'
      }
    },
    updateClientPayment() {
      const payload = {
        code: this.$route.params.code,
        id: this.client.id,
        payment_mode: parseInt(this.form.paymentMode)
      }

      try {
        this.client = this.updatePayment(payload)
        this.$toast.open({
          message: 'Successfully updated payment mode',
          type: 'is-success'
        })
      } catch (e) {
        this.$toast.open({
          message: e.message,
          type: 'is-danger'
        })
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/pages/clients/details.scss";
</style>
