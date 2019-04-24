import Vue from 'vue'
import VueCookies from 'vue-cookies'
import axios from 'axios'

Vue.use(VueCookies)

const state = {
  currentLoggedInUser: VueCookies.get('current_user'),
  accessToken: VueCookies.get('auth_token')
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

      VueCookies.set('auth_token', data.access_token.token)
      VueCookies.set('current_user', data.logged_in_user.username)

      commit('setCurrentLoggedInUser', data.logged_in_user.username)
      commit('setAccessToken', data.access_token.token)
    } catch (e) {
      const { data } = e.response
      throw data
    }
  },

  logout({ state }, payload) {
    VueCookies.remove('auth_token')
    VueCookies.remove('current_user')

    state.currentLoggedInUser = null;
    state.accessToken = null;
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}