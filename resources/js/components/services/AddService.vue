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
        code: null,
        name: null,
        default_cost: null
      }
    }
  },
  methods: {
    async submit() {
      const result = await this.validateBeforeSubmit()
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/services/addService.scss";
</style>
