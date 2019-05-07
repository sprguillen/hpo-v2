import Vue from 'vue'
import VueCookies from 'vue-cookies'
import axios from 'axios'

Vue.use(VueCookies)

axios.interceptors.request.use((config) => {
  config.headers['Authorization'] = `Bearer ${VueCookies.get('access_token')}`
  config.headers['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content
  return config
}, (error) => {
  return Promise.reject(error)
})

const state = {
  clients: [],
  lastPage: 1
}

const getters = {
  getClients: state => {
    return state.clients
  },
  getLastPage: state => {
    return state.lastPage
  }
}

const mutations = {
  setClients: (state, clients) => {
    state.clients = clients
  },
  setLastPage: (state, lastPage) => {
    state.lastPage = lastPage
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

  async fetchClients({ commit }, params) {
    let url = '/api/admin/client'
    if (params.page) {
      url += `?page=${params.page}`
    }
    try {
      const { data } = await axios.get(url)
      commit('setClients', data.clients.data)
      commit('setLastPage', data.clients.last_page)
    } catch (e) {
      const { data } = e.response
      throw data
    }
  },

  async searchClients({ commit }, params) {
    try {
      const { data } = await axios.get(`/api/admin/client/search/${params.key}`)
      commit('setClients', data.clients.data)
      commit('setLastPage', data.clients.last_page)
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