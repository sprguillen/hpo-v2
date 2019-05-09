<template>
  <section class="test-announcement">
    <div class="column">
      <div class="columns">
        <div class="column no-left-padding is-half">
          <h2>Test/Services Announcements</h2>
          <br>
          <b-field
            label="Topic"
            :type="{'is-danger': errors.has('topic')}"
            :message="errors.first('topic')"
          >
            <b-input
              v-model="form.topic"
              v-validate="rules.topic"
              name="topic"
            />
          </b-field>
          <b-field
            label="Content"
            :type="{'is-danger': errors.has('content')}"
            :message="errors.first('content')"
          >
            <b-input
              v-model="form.content"
              v-validate="rules.content"
              name="content"
              type="textarea"
            />
          </b-field>
          <b-button
            tag="input"
            type="app-primary"
            native-type="submit"
          >
            Save
          </b-button>
        </div>
        <div class="column">
          <h2>Availability of Post</h2>
          <br>
          <b-field label="Start/End">
            <date-range-picker 
              v-model="dateRange"
              @update="onDateSelected"
            />
          </b-field>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import moment from 'moment'
import DateRangePicker from 'vue2-daterange-picker'
import validationMixin from '@/mixins/validation'

import 'vue2-daterange-picker/dist/lib/vue-daterange-picker.min.css'

export default {
  components: {
    DateRangePicker
  },
  mixins: [validationMixin],
  data() {
    let futureDate = new Date()
    futureDate.setDate(futureDate.getDate() + 5)

    return {
      form: {
        topic: null,
        content: null,
        start: moment(new Date()).format('YYYY-MM-DD'),
        end: moment(futureDate).format('YYYY-MM-DD')
      },
      dateRange: {
        startDate: new Date(),
        endDate: futureDate
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
  },
  methods: {
    onDateSelected() {
      this.form.start = moment(this.dateRange.startDate).format('YYYY-MM-DD')
      this.form.end = moment(this.dateRange.endDate).format('YYYY-MM-DD')
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/system/testAnnouncements.scss";
</style>
