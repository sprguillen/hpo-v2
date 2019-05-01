import Vue from 'vue'
import VueCookies from 'vue-cookies'
import axios from 'axios'

Vue.use(VueCookies)

axios.interceptors.request.use((config) => {
  config.headers['Authorization'] = `Bearer ${VueCookies.get('auth_token')}`
  config.headers['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content
  return config
}, (error) => {
  return Promise.reject(error)
})

const state = {
  clients: []
}

const getters = {
  getClients: state => state.clients
}

const mutations = {
  setClients: (state, clients) => {
    state.clients = clients
  }
}

const actions = {
  async addClient({ commit }, payload) {
    try {
      const { data } = await axios.post('/api/admin/client/store', payload)
      return data
    } catch (e) {
      const { data } = e.response
      throw data
    }
  },

  async getClient({ commit }) {
    try {
      const { data } = await axios.get('/api/admin/client')
      console.log(data)
      // commit('setClients', data)
    } catch (e) {
      const { data } = e.response
      throw data
    }
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}