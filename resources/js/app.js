
import Vue from 'vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import router from './router'

Vue.use(BootstrapVue)
Vue.use(VueRouter)

const app = new Vue({
  router
}).$mount('#app')
