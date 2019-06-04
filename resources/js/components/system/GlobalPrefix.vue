<template>
  <section class="global-prefix">
    <div class="column">
      <div class="columns">
        <div class="">
          <b-field
            label="Prefix"
          >
            <b-input
              v-model="form.prefix"
              name="prefix"
            />
          </b-field>
          <b-button
            tag="button"
            type="app-primary"
            class="btn-save"
          >
            Save
          </b-button>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      form: {
        prefix: null
      }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/system/globalPrefix.scss";
</style>