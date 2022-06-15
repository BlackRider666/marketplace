import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'

Vue.use(Vuetify)
const theme = {
  primary: '#1D3543',
  secondary: '#35404A',
  accent: '#ccde44',
  error: '#FF5252',
  info: '#2196F3',
  success: '#2ABC41',
  warning: '#FFC107'
}
export default new Vuetify({
  icons: {
    iconfont: 'mdi' // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg'
  },
  theme: {
    themes: {
      dark: theme,
      light: theme
    }
  }
})
