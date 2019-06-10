
import Vue from 'vue'
import VueRouter from 'vue-router'
import VeeValidate from 'vee-validate'
import VueCookies from 'vue-cookies'
import Buefy from 'buefy'
import vSelect from 'vue-select'

import router from './router'
import store from './store'

import 'buefy/dist/buefy.css'
import 'vue-select/dist/vue-select.css';

Vue.use(Buefy)
Vue.use(VueRouter)
Vue.use(VeeValidate)
Vue.use(VueCookies)
Vue.use(VeeValidate, { events: '' })
Vue.component('v-select', vSelect)

VueCookies.config('1d')

const app = new Vue({
  router,
  store,
}).$mount('#app')
