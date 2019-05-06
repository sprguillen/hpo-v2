export default {
  methods: {
    async validateBeforeSubmit() {
      const result = await this.$validator.validateAll()
      if (result) {
        return true
      } else {
        this.$toasted.error('Please fill out the required fields')
        return false
      }
    },
    clearErrors() {
      this.$validator.reset()
    }
  }
}