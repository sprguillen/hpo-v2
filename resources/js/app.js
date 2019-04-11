
import Vue from 'vue'
import VueRouter from 'vue-router'
import Toasted from 'vue-toasted'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import router from './router'
import store from './store'

Vue.use(Buefy)
Vue.use(VueRouter)

const toastedOptions = {
  position: 'top-center',
  duration: 5000
}

Vue.use(Toasted, toastedOptions)

const app = new Vue({
  router,
  store,
}).$mount('#app')
