<template>
  <div class="container">
    <div class="newpass-content">
      <div class="row justify-content-center">
        <div class="col-6">
          <div class="card card-default">
            <div class="card-header">
              New Password
            </div>
            <div class="card-body">
              <form 
                autocomplete="off" 
                method="post" 
                @submit.prevent="resetPassword"
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
                <div class="form-group">
                  <label for="email">Password</label>
                  <input
                    id="password"
                    v-model="password"
                    type="password"
                    class="form-control"
                    placeholder
                    required
                  >
                </div>
                <div class="form-group">
                  <label for="email">Confirm Password</label>
                  <input
                    id="password_confirmation"
                    v-model="password_confirmation"
                    type="password"
                    class="form-control"
                    placeholder
                    required
                  >
                </div>
                <button 
                  type="submit" 
                  class="btn btn-primary"
                >
                  Update
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
.newpass-content {
  margin-top: 10%;
}
</style>