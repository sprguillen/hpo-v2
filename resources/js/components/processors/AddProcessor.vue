<template>
  <div class="column portlet">
    <section class="add-processor">
      <h1 class="float-left">PROCESSOR REGISTRATION</h1>
      <b-button
        icon-left="close"
        @click="$emit('hide')"
        class="float-right app-text-primary">
      </b-button>
      <div class="clearfix" />
      <hr />
      <form @submit.prevent="submit">
        <b-field label="Account Details" horizontal grouped>
          <b-field :type="{'is-danger': errors.has('username')}"
            :message="errors.first('username')">
            <b-input
              v-model="form.username"
              v-validate="rules.username"
              name="username"
              placeholder="Username"
              icon="account">
            </b-input>
          </b-field>
          <b-field :type="{'is-danger': errors.has('email')}"
            :message="errors.first('email')">
            <b-input
              v-model="form.email"
              v-validate="rules.email"
              name="email"
              placeholder="Email"
              icon="email">
            </b-input>
          </b-field>
        </b-field>
        <b-field label="Full Name" horizontal grouped>
          <b-field :type="{'is-danger': errors.has('first-name')}"
            :message="errors.first('first-name')">
            <b-input
              v-model="form.firstName"
              v-validate="rules.firstName"
              name="first-name"
              placeholder="First Name"
              icon="account-card-details">
            </b-input>
          </b-field>
          <b-field :type="{'is-danger': errors.has('last-name')}"
            :message="errors.first('last-name')">
            <b-input
              v-model="form.lastName"
              v-validate="rules.lastName"
              name="last-name"
              placeholder="Last Name"
              icon="account-card-details">
            </b-input>
          </b-field>
        </b-field>
        <b-field label="Set password" horizontal grouped>
          <b-field :type="{'is-danger': errors.has('password')}"
            :message="errors.first('password')">
            <b-input
              v-model="form.password"
              v-validate="rules.password"
              name="password"
              placeholder="Password"
              type="password"
              icon="lock">
            </b-input>
          </b-field>
          <b-field :type="{'is-danger': errors.has('confirm-password')}"
            :message="errors.first('confirm-password')">
            <b-input
              v-model="form.confirmPassword"
              v-validate="rules.confirmPassword"
              name="confirm-password"
              placeholder="Confirm Password"
              type="password"
              icon="check">
            </b-input>
          </b-field>
        </b-field>
        <hr />
        <b-button
          tag="input"
          class="float-right"
          type="app-primary"
          native-type="submit">Save</b-button>
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
        username: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        firstName: {
          required: true
        },
        lastName: {
          required: true
        },
        password: {
          required: true
        },
        confirmPassword: {
          required: true,
          confirmed: 'password'
        }
      },
      form: {
        username: null,
        email: null,
        firstName: null,
        lastName: null,
        password: null,
        confirmPassword: null
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
  @import "../../../sass/components/processors/addProcessor.scss";
</style>
