import axios from 'axios'

const state = {
  token: localStorage.getItem('token') || ''
}

const getters = {
  getAuthToken: (state) => {
    return state.token
  }
}

const actions = {
  login ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('auth/login', payload)
        .then(res => {
          commit('SET_AUTH_TOKEN', res.data.token)
          resolve(res.data.token)
        })
        .catch(errors => {
          reject(errors)
        })
    })
  },
  register ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('auth/register', payload)
        .then(res => {
          commit('SET_AUTH_TOKEN', res.data.token)
          resolve(res.data.token)
        })
        .catch(errors => {
          reject(errors)
        })
    })
  },
  logout ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.post('/auth/logout')
        .then(res => {
          commit('CLEAR_AUTH_TOKEN')
          resolve(res.data)
        })
        .catch(errors => {
          commit('CLEAR_AUTH_TOKEN')
          reject(errors)
        })
    })
  }
}

const mutations = {
  CLEAR_AUTH_TOKEN (state) {
    state.token = ''
    localStorage.removeItem('token')
  },
  SET_AUTH_TOKEN (state, token) {
    state.token = token
    localStorage.setItem('token', token)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
