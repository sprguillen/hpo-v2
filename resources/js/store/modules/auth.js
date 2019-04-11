import axios from 'axios'

const state = {
  currentLoggedInUser: null,
  accessToken: null
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
      commit('setAccessToken', data.access_token)
      commit('setCurrentLoggedInUser', data.logged_in_user)

      document.cookie = `user_id=${data.logged_in_user.id}; auth=${data.access_token.token}`
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