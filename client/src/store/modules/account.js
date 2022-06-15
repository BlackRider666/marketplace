import axios from 'axios'

const state = {
  user: JSON.parse(localStorage.getItem('account')) || {}
}

const getters = {
  getAccount: (state) => {
    return state.user
  }
}

const actions = {
  downloadAccount ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('auth/user')
        .then(res => {
          commit('UPDATE_ACCOUNT', res.data.user)
          resolve(res.data.user)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  },
  update ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('auth/user/update', payload)
        .then(res => {
          commit('UPDATE_ACCOUNT', res.data.user)
          resolve(res.data.user)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  },
  updatePassword ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('auth/user/change-password', payload)
        .then(res => {
          commit('UPDATE_ACCOUNT', res.data.user)
          resolve(res.data.user)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  },
  updatePhoto ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('auth/user/update-photo', payload)
        .then(res => {
          commit('UPDATE_ACCOUNT', res.data.user)
          resolve(res.data.user)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  }
}

const mutations = {
  UPDATE_ACCOUNT (state, account) {
    state.user = account
    localStorage.setItem('account', JSON.stringify(account))
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
