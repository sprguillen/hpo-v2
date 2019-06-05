<template>
  <div class="container">
    <div class="resetpass-content">
      <div class="row justify-content-center">
        <div class="col-6">
          <div class="card card-default">
            <div class="card-header">
              Reset Password 
            </div>
            <div class="card-body">
              <form 
                autocomplete="off" 
                method="post"
                @submit.prevent="requestResetPassword" 
              >
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input
                    id="email"
                    v-model="email"
                    type="email"
                    class="form-control"
                    placeholder="user@example.com"
                    required
                  >
                </div>

                <button 
                  type="submit" 
                  class="btn btn-primary"
                >
                  Send Password Reset Link
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>
<style lang="scss" scoped>
@import "../../../sass/pages/auth/login.scss";
.resetpass-content {
  margin-top: 10%;
}
</style>