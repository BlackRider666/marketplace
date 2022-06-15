import Vue from 'vue'
import Vuex from 'vuex'
import l10s from './modules/l10s'

import notifier from './modules/notifier/index'
import auth from './modules/auth'
import account from './modules/account'
import companyDirection from './modules/companyDirection'
import location from './modules/account/location'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    showLoading: false
  },
  getters: {
  },
  mutations: {
    SET_SHOW_LOADING (store, val) {
      store.showLoading = val
    }
  },
  actions: {
  },
  modules: {
    notifier: notifier.store,
    l10s,
    auth,
    account,
    companyDirection,
    location
  }
})

Vue.use(notifier.plugin, store)

export default store
