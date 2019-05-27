import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueCookies from 'vue-cookies'

// router
import router from '@/router'

// Modules
import auth from '@/store/modules/auth'
import client from '@/store/modules/client'
import processor from '@/store/modules/processor'
import service from '@/store/modules/service'

Vue.use(Vuex)

/**
 * This line of code is used to intercept errors on calling the api
 * if the oauth access_token is expired when consuming the api
 * it should be handled by axios on the vuex calls (since all API
 * calls are done on vuex) thus removing the cookie and logging the
 * user out immediately
 */
const errorResponseHandler = (error) => {
  if (error.response.status === 401) {
    VueCookies.remove('access_token')
    VueCookies.remove('refresh_token')
    VueCookies.remove('user_name')
    VueCookies.remove('user_role')
    router.push({ name: 'login' })
  } 
}

axios.interceptors.response.use(
  response => response,
  errorResponseHandler
)

export default new Vuex.Store({
  modules: {
    auth,
    client,
    processor,
    service
  }
})