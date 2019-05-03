<template>
  <div class="column portlet">
    <section class="add-service">
      <h1 class="float-left">
        SERVICE REGISTRATION
      </h1>
      <b-button
        icon-left="close"
        class="float-right app-text-primary"
        @click="$emit('hide')"
      />
      <div class="clearfix" />
      <hr>
      <form @submit.prevent="submit">
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
        <hr>
        <b-button
          tag="input"
          class="float-right"
          type="app-primary"
          native-type="submit"
        >
          Save
        </b-button>
        <div class="clearfix" />
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
