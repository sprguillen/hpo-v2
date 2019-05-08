export default {
  methods: {
    async validateBeforeSubmit() {
      const result = await this.$validator.validateAll()
      if (result) {
        return true
      } else {
        this.$toast.open({
          message: 'Please fill out the required fields',
          type: 'is-danger'
        })
        return false
      }
    },
    clearErrors() {
      this.$validator.reset()
    }
  }
}