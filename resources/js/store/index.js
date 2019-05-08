import Vue from 'vue'
import Vuex from 'vuex'

// Modules
import auth from '@/store/modules/auth'
import client from '@/store/modules/client'
import processor from '@/store/modules/processor'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth,
    client,
    processor
  }
})