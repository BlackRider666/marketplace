import axios from 'axios'

const state = {
  directions: []
}

const getters = {
  getDirections: (state) => {
    return state.directions
  }
}

const actions = {
  downloadDirections ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('company-directions')
        .then(res => {
          commit('UPDATE_DIRECTIONS', res.data.directions)
          resolve(res.data.directions)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  }
}

const mutations = {
  UPDATE_DIRECTIONS (state, directions) {
    state.directions = directions
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
