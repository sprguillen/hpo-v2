import Vue from 'vue'
import VueCookies from 'vue-cookies'
import axios from 'axios'
import { CLIENT_ID, CLIENT_SECRET, GRANT_TYPE } from '../../utils/constants'

Vue.use(VueCookies)

const state = {
  accessToken: VueCookies.get('access_token'),
  refreshToken: VueCookies.get('refresh_token')
}

const getters = {
  getAccessToken: state => state.accessToken,
  getRefreshToken: state => state.refreshToken
}

const mutations = {
  setAccessToken: (state, accessToken) => {
    state.accessToken = accessToken
  },
  setRefreshToken: (state, refreshToken) => {
    state.refreshToken = refreshToken
  }
}

const actions = {
  async login({ commit }, payload) {
    try {
      payload.grant_type = GRANT_TYPE
      payload.client_id = CLIENT_ID
      payload.client_secret = CLIENT_SECRET
      const { data } = await axios.post('/api/auth/login', payload)
      VueCookies.set('access_token', data.access_token)
      VueCookies.set('refresh_token', data.refresh_token)

      commit('setAccessToken', data.access_token)
      commit('setRefreshToken', data.refresh_token)
    } catch (e) {
      const { data } = e.response
      throw data
    }
  },

  logout({ state }) {
    VueCookies.remove('access_token')
    VueCookies.remove('refresh_token')

    state.accessToken = null;
    state.refreshToken = null;
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}