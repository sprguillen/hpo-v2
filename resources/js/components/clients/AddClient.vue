<template>
  <div class="column portlet">
    <section class="add-client">
      <h1 class="float-left">
        CLIENT REGISTRATION
      </h1>
      <b-button
        icon-left="close"
        class="float-right app-text-primary hide-button"
        @click="$emit('hide')"
      />
      <div class="clearfix" />
      <hr>
      <form @submit.prevent="submit">
        <b-field grouped>
          <b-field
            label="Username"
            :type="{'is-danger': errors.has('username')}"
            :message="errors.first('username')"
            expanded
          >
            <b-input
              v-model="form.username"
              v-validate="rules.username"
              name="username"
              placeholder="Username"
              icon="account"
            />
          </b-field>
          <b-field
            label="Email Address"
            :type="{'is-danger': errors.has('email')}"
            :message="errors.first('email')"
            expanded
          >
            <b-input
              v-model="form.email"
              v-validate="rules.email"
              name="email"
              placeholder="Email"
              icon="email"
              expanded
            />
          </b-field>
        </b-field>
        <b-field grouped>
          <b-field
            label="First Name"
            :type="{'is-danger': errors.has('first-name')}"
            :message="errors.first('first-name')"
            expanded
          >
            <b-input
              v-model="form.first_name"
              v-validate="rules.firstName"
              name="first-name"
              placeholder="First Name"
              icon="account-card-details"
            />
          </b-field>
          <b-field
            label="Last Name"
            :type="{'is-danger': errors.has('last-name')}"
            :message="errors.first('last-name')"
            expanded
          >
            <b-input
              v-model="form.last_name"
              v-validate="rules.lastName"
              name="last-name"
              placeholder="Last Name"
              icon="account-card-details"
            />
          </b-field>
        </b-field>
        <b-field grouped>
          <b-field
            label="Password"
            :type="{'is-danger': errors.has('password')}"
            :message="errors.first('password')"
            expanded
          >
            <b-input
              ref="password"
              v-model="form.password"
              v-validate="rules.password"
              name="password"
              placeholder="Password"
              type="password"
              icon="lock"
            />
          </b-field>
          <b-field
            label="Confirm Password"
            :type="{'is-danger': errors.has('confirm-password')}"
            :message="errors.first('confirm-password')"
            expanded
          >
            <b-input
              v-model="form.password_confirmation"
              v-validate="rules.confirmPassword"
              name="confirm-password"
              placeholder="Confirm Password"
              type="password"
              icon="check"
            />
          </b-field>
        </b-field>
        <hr>
        <b-button
          tag="input"
          type="app-primary"
          native-type="submit"
        >
          Save
        </b-button>
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
        username: '',
        email: '',
        first_name: '',
        last_name: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    ...mapActions('client', ['addClient']),
    async submit() {
      const result = await this.validateBeforeSubmit()

      try {
        const data = await this.addClient(this.form)
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
        this.$toast.open({
          message: e.message,
          type: 'is-danger'
        })
      }
    },
    clearForm() {
      this.form.username = ''
      this.form.email = ''
      this.form.first_name = ''
      this.form.last_name = ''
      this.form.password = ''
      this.form.password_confirmation = ''
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/clients/addClient.scss";
</style>
