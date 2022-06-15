const NotifierStore = {
  namespaced: true,
  state: {
    content: '',
    contentTKey: '',
    color: '',
    options: {},
  },
  actions: {
    showMessage ({ commit }, payload) {
      commit('SHOW_MESSAGE', payload)
    }
  },
  mutations: {
    SHOW_MESSAGE (state, payload) {
      state.content = payload.content
      state.contentTKey = payload.contentTKey
      state.color = payload.color
      state.options = payload.options
    }
  },
  getters: {}
}

export default NotifierStore
