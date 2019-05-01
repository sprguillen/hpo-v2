<template>
  <section class="test-announcement">
    <div class="column">
      <div class="columns">
        <div class="column no-left-padding is-half">
          <h2>Test/Services Announcements</h2>
          <br />
          <b-field label="Topic" :type="{'is-danger': errors.has('topic')}"
            :message="errors.first('topic')">
            <b-input
              v-model="form.topic"
              v-validate="rules.topic"
              name="topic">
            </b-input>
          </b-field>
          <b-field label="Content" :type="{'is-danger': errors.has('content')}"
            :message="errors.first('content')">
            <b-input
              v-model="form.content"
              v-validate="rules.content"
              name="content"
              type="textarea">
            </b-input>
          </b-field>
          <b-button
            tag="input"
            type="app-primary"
            native-type="submit">Save</b-button>
        </div>
        <div class="column">
          <h2>Availability of Post</h2>
          <br />
          <div class="column no-top-padding is-half">
            <b-field label="From">
              <b-input
                v-model="form.from"
                name="from"
                disabled>
              </b-input>
            </b-field>
            <b-field label="To">
              <b-input
                v-model="form.to"
                name="to"
                disabled>
              </b-input>
            </b-field>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import validationMixin from '@/mixins/validation'

export default {
  mixins: [validationMixin],
  data() {
    return {
      form: {
        topic: null
      },
      rules: {
        topic: {
          required: true
        },
        content: {
          required: true
        }
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/system/testAnnouncements.scss";
</style>
