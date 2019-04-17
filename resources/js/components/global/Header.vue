<template>
  <header class="page-header">
    <nav class="navbar mega-menu" role="navigation">
      <div class="container-fluid">
        <div class="clearfix navbar-fixed-top">
          <a class="navbar-brand">
            <img class="company-logo" src="/images/header_logo.png">
          </a>
          <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="nav-content">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
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
      <div class="container-fluid mt-3">
        <div class="nav-content navbar-menu">
          <div class="navbar-start">
            <router-link to="/" class="navbar-item main-nav">
              <b-icon icon="home"></b-icon>
              <span>Dashboard</span>
            </router-link>
            <router-link to="/" class="navbar-item main-nav">
              <b-icon icon="account-star"></b-icon>
              <span>Clients</span>
            </router-link>
            <router-link to="/" class="navbar-item main-nav">
              <b-icon icon="incognito"></b-icon>
              <span>Processors</span>
            </router-link>
            <router-link to="/" class="navbar-item main-nav">
              <b-icon icon="stethoscope"></b-icon>
              <span>Batch Orders</span>
            </router-link>
            <router-link to="/" class="navbar-item main-nav">
              <b-icon icon="hospital"></b-icon>
              <span>Services</span>
            </router-link>
            <router-link to="/" class="navbar-item main-nav">
              <b-icon icon="settings"></b-icon>
              <span>System</span>
            </router-link>
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
