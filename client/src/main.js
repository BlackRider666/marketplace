import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import './plugins/axios'
import loading from './plugins/loading'
import l10s from './plugins/l10s'
import CountryFlag from 'vue-country-flag'

Vue.component('country-flag', CountryFlag)

Vue.use(l10s, store)
Vue.use(loading)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App)
}).$mount('#app')
