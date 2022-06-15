import axios from 'axios'

const state = {
  location: {},
  countries: [],
  regions: [],
  cities: []
}

const getters = {
  getLocation: (state) => {
    return state.location
  },
  getCountries: (state) => {
    return state.countries
  },
  getRegions: (state) => {
    return state.regions
  },
  getCities: (state) => {
    return state.cities
  }
}

const actions = {
  downloadLocation ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('auth/user/location')
        .then(res => {
          commit('UPDATE_LOCATION', res.data.location)
          resolve(res.data.location)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  },
  update ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('auth/user/location/update', payload)
        .then(res => {
          commit('UPDATE_LOCATION', res.data.location)
          resolve(res.data.location)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  },
  downloadCountries ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('countries')
        .then(res => {
          commit('UPDATE_COUNTRIES', res.data.countries)
          resolve(res.data.countries)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  },
  downloadRegions ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.get('regions/' + payload)
        .then(res => {
          commit('UPDATE_REGIONS', res.data.regions)
          resolve(res.data.regions)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  },
  downloadCities ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.get('cities/' + payload)
        .then(res => {
          commit('UPDATE_CITIES', res.data.cities)
          resolve(res.data.cities)
        })
        .catch(errors => {
          reject(errors.response.data)
        })
    })
  },
  clearRegions ({ commit }) {
    commit('CLEAR_REGIONS')
  },
  clearCities ({ commit }) {
    commit('CLEAR_CITIES')
  }
}

const mutations = {
  UPDATE_LOCATION (state, location) {
    state.location = location
  },
  UPDATE_COUNTRIES (state, countries) {
    state.countries = countries
  },
  UPDATE_REGIONS (state, regions) {
    state.regions = regions
  },
  UPDATE_CITIES (state, cities) {
    state.cities = cities
  },
  CLEAR_REGIONS (state) {
    state.regions = []
  },
  CLEAR_CITIES (state) {
    state.cities = []
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
