const Plugin = {}

Plugin.install = function install (Vue, store) {
  Vue.prototype.$notify = function (contentTKey = '', color = '', content = '', options = {}) {
    store.dispatch('notifier/showMessage', { contentTKey, color, content, options })
  }
}

export default Plugin
