import axios from 'axios'

const state = {
  currentLoggedInUser: localStorage.getItem('current_user'),
  accessToken: localStorage.getItem('auth_token')
}

const getters = {
  getCurrentLoggedInUser: state => state.currentLoggedInUser,
  getAccessToken: state => state.accessToken
}

const mutations = {
  setCurrentLoggedInUser: (state, user) => {
    state.currentLoggedInUser = user
  },
  setAccessToken: (state, token) => {
    state.accessToken = token
  }
}

const actions = {
  async login({ commit }, payload) {
    try {
      const { data } = await axios.post('/api/auth/login', payload)

      localStorage.setItem('auth_token', data.access_token.token)
      localStorage.setItem('current_user', data.logged_in_user.username)

      commit('setCurrentLoggedInUser', data.logged_in_user.username)
      commit('setAccessToken', data.access_token.token)
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