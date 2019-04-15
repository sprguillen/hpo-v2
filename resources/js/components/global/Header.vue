<template>
  <header class="page-header">
    <nav class="navbar mega-menu" role="navigation">
      <div class="container-fluid">
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
                  SIGN OUT
                </div>
              </template>
            </b-dropdown>
            <b-dropdown position="is-bottom-left" aria-role="menu">
              <a class="navbar-item" slot="trigger" role="button">
                <b-icon icon="account"></b-icon>
                <span>Menu</span>
                <b-icon icon="menu-down"></b-icon>
              </a>

              <template slot="default" class="dropdown-class">
                <div class="dropdown-item">
                  SIGN OUT
                </div>
              </template>
            </b-dropdown>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>
<script>
export default {
  
}
</script>
<style lang="scss" scoped>
  @import "../../../sass/components/global/header.scss";
</style>
