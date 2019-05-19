<template>
  <div class="column portlet">
    <section class="add-service">
      <div class="column">
        <div class="header-portlet">
          <h1 class="float-left">
            SERVICE REGISTRATION
          </h1>
          <b-icon
            icon="close"
            class="float-right app-text-primary pointer"
            size="is-small"
            @click.native="$emit('hide')"
          />
        </div>
      </div>
      <form @submit.prevent="submit">
        <div class="column">
          <div class="columns">
            <div class="column">
              <b-field
                label="Code"
                :type="{'is-danger': errors.has('code')}"
                :message="errors.first('code')"
              >
                <b-input
                  v-model="form.code"
                  v-validate="rules.code"
                  name="code"
                  placeholder="Code"
                  icon="key"
                />
              </b-field>
            </div>
          </div>
          <div class="columns">
            <div class="column">
              <b-field
                label="Name"
                :type="{'is-danger': errors.has('name')}"
                :message="errors.first('name')"
              >
                <b-input
                  v-model="form.name"
                  v-validate="rules.name"
                  name="name"
                  placeholder="Name"
                  icon="tag"
                />
              </b-field>
            </div>
          </div>
          <div class="columns">
            <div class="column">
              <b-field
                label="Default Cost"
                :type="{'is-danger': errors.has('default-cost')}"
                :message="errors.first('default-cost')"
              >
                <b-input
                  v-model="form.default_cost"
                  v-validate="rules.defaultCost"
                  name="default-cost"
                  placeholder="Default Cost"
                  icon="currency-usd"
                />
              </b-field>
            </div>
          </div>
          <hr>
          <b-button
            tag="input"
            type="app-primary"
            native-type="submit"
          >
            Save
          </b-button>
        </div>
      </form>
    </section>
  </div>
</template>
<script>
import { mapActions } from 'vuex' 
import validationMixin from '@/mixins/validation'

export default {
  mixins: [validationMixin],
  data() {
    return {
      rules: {
        code: {
          required: true
        },
        name: {
          required: true
        },
        defaultCost: {
          required: true
        }
      },
      form: {
        code: '',
        name: '',
        default_cost: ''
      }
    }
  },
  methods: {
    ...mapActions('service', ['addService']),
    async submit() {
      const result = await this.validateBeforeSubmit()

      try {
        const data = await this.addService(this.form)
        if (data.success) {
          this.$toast.open({
            message: data.message,
            type: 'is-success'
          })

          this.clearForm()
          this.clearErrors()
          this.$emit('success')
        }
      } catch (e) {
        if (e.errors) {
          if (e.errors.code) {
            e.errors.code.forEach((error) => {
              this.$toast.open({
                message: `Service with code ${this.form.code} already exists`,
                type: 'is-danger'
              })
            })
          } else if (e.errors.name) {
            e.errors.name.forEach((error) => {
              this.$toast.open({
                message: `Service with code ${this.form.name} already exists`,
                type: 'is-danger'
              })
            })
          }
        } else {
          this.$toast.open({
            message: e.message,
            type: 'is-danger'
          })
        }
      }
    },
    clearForm() {
      this.form.code = ''
      this.form.name = ''
      this.form.default_cost = ''
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/services/addService.scss";
</style>
