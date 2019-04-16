
import Vue from 'vue'
import VueRouter from 'vue-router'
import VeeValidate from 'vee-validate'
import VueCookies from 'vue-cookies'
import Toasted from 'vue-toasted'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import router from './router'
import store from './store'

Vue.use(Buefy)
Vue.use(VueRouter)
Vue.use(VeeValidate)
Vue.use(VueCookies)

const toastedOptions = {
  position: 'top-center',
  duration: 5000
}

Vue.use(Toasted, toastedOptions)
Vue.use(VeeValidate, { events: '' })

const app = new Vue({
  router,
  store,
}).$mount('#app')
