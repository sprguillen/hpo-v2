
import Vue from 'vue'
import VueRouter from 'vue-router'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import router from './router'

Vue.use(Buefy)
Vue.use(VueRouter)

const app = new Vue({
  router
}).$mount('#app')
