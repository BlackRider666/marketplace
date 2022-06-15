import store from '../store/index'

const L10s = {
  translations: store.getters['l10s/translations'] || {},
  untranslatedKeys: [],
  onUntranslatedKeyFoundCallback: (key, value) => {},
  install (Vue) {
    Vue.prototype.$t = (key, value) => {
      const translations = store.getters['l10s/translations']
      if (translations[key] !== undefined && translations[key].length > 0) {
        return translations[key]
      }
      this.untranslatedKeys.push({ key, value })
      this.onUntranslatedKeyFoundCallback(key, value)
      return value
    }

    Vue.prototype.l10s = {
      onUntranslatedKeyFound: (cb) => {
        this.onUntranslatedKeyFoundCallback = cb.bind(this)
      },
      getUntranslatedKeys: () => this.untranslatedKeys,
      cleanUntranslatedKeys: () => {
        this.untranslatedKeys = []
      }
    }
  }
}

export default L10s
