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
  processors: [],
  lastPage: 1
}

const getters = {
  getProcessors: state => {
    return state.processors
  },
  getLastPage: state => {
    return state.lastPage
  }
}

const mutations = {
  setProcessors: (state, processors) => {
    state.processors = processors
  },
  setLastPage: (state, lastPage) => {
    state.lastPage = lastPage
  }
}

const actions = {
  async addProcessor({}, payload) {
    try {
      const { data } = await axios.post('/api/admin/processor/store', payload)
      return data
    } catch (e) {
      const { data } = e.response
      throw data
    }
  },

  async fetchProcessors({ commit }, params) {
    let url = '/api/admin/processor'
    if (params.page) {
      url += `?page=${params.page}`
    }
    try {
      const { data } = await axios.get(url)
      commit('setProcessors', data.processors.data)
      commit('setLastPage', data.processors.last_page)
    } catch (e) {
      const { data } = e.response
      throw data
    }
  },

  // async searchProcessors({ commit }, params) {
  //   try {
  //     const { data } = await axios.get(`/api/admin/processor/search/${params.key}`)
  //     commit('setProcessors', data.processors.data)
  //     commit('setLastPage', data.processors.last_page)
  //   } catch (e) {
  //     const { data } = e.response
  //     throw data
  //   }
  // }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}