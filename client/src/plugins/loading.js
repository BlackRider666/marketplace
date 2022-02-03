import store from '../store/index'
const Plugin = {}

Plugin.install = function install (Vue) {
  Vue.$loading = Vue.prototype.$loading = function () {
    // document.querySelector('#app .loading-show').classList.add('con-vs-loading');
    store.commit('SET_SHOW_LOADING', true)
  }
  Vue.$loadingClose = Vue.prototype.$loadingClose = function () {
    // document.querySelector('#app .loading-show').classList.remove('con-vs-loading');
    store.commit('SET_SHOW_LOADING', false)
  }
}

export default Plugin

if (typeof window !== 'undefined' && window.Vue) {
  window.Vue.use(Plugin)
}
