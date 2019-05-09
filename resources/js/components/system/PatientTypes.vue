<template>
  <section class="patient-type">
    <div class="column portlet">
      <div class="header-portlet">
        <h2 class="float-left">
          PATIENT TYPES
        </h2>
        <div class="mini-form float-right">
          <form @submit.prevent="submit">
            <b-field grouped>
              <b-input
                placeholder="Code"
                size="is-small"
              />
              <b-input
                placeholder="Name"
                size="is-small"
              />
              <b-button
                size="is-small"
                tag="input"
                type="app-primary"
                native-type="submit"
              >
                Save
              </b-button>
            </b-field>
          </form>
        </div>
        <br>
        <div class="clearfix" />
      </div>
    </div>
  </section>
</template>
<script>
export default {
  
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/system/patientTypes.scss";
</style>
