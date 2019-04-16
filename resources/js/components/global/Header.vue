<template>
  <header class="page-header">
    <nav class="navbar mega-menu" role="navigation">
      <div class="container-fluid">
        <div class="clearfix navbar-fixed-top">
          <a class="navbar-brand">
            <img class="company-logo" src="/images/header_logo.png">
          </a>
          <div class="navbar-end">
            <div class="topbar-actions">
              <b-dropdown position="is-bottom-left" aria-role="menu">
                <a class="navbar-item" slot="trigger" role="button">
                  <b-icon icon="bell"></b-icon>
                  <span>Announcements</span>
                  <b-icon icon="menu-down"></b-icon>
                </a>

                <template slot="default" class="dropdown-class">
                  <div class="dropdown-item">
                    Sign out
                  </div>
                </template>
              </b-dropdown>
              <b-dropdown position="is-bottom-left" aria-role="menu">
                <a class="navbar-item" slot="trigger" role="button">
                  <b-icon icon="account"></b-icon>
                  <span>Hi, {{ getCurrentLoggedInUser }}</span>
                  <b-icon icon="menu-down"></b-icon>
                </a>

                <template slot="default" class="dropdown-class">
                  <div class="dropdown-item" @click="exit">
                    Sign out
                  </div>
                </template>
              </b-dropdown>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters('auth', [ 'getCurrentLoggedInUser' ])
  },
  methods: {
    ...mapActions('auth', [ 'logout' ]),
    exit() {
      this.logout()
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/global/header.scss";
</style>
