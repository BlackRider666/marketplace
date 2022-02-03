import Vue from 'vue'
import store from '../store/index'
import router from '../router'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)
const baseURL = process.env.VUE_APP_API_BASE_URL

axios.interceptors.request.use(config => {
  config.baseURL = baseURL
  config.headers.common['Access-Control-Allow-Origin'] = '*'
  config.headers.common['X-Requested-With'] = 'XMLHttpRequest'
  config.headers.common['Content-Type'] = 'application/json'
  config.headers.common.Accept = 'application/json'
  // add token if exist
  const token = store.state.auth.token
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
}, err => Promise.reject(err))

axios.interceptors.response.use(
  response => response,
  error => {
    const vm = new Vue()

    if (error.response) {
      const status = error.response.status

      switch (status) {
        case 401:
          store.commit('auth/CLEAR_AUTH_TOKEN')
          if (router.currentRoute.name !== 'login') {
            router.push({ name: 'login' })
          }
          break
        case 403:
          router.push({ name: 'error-403' })
          break
        case 422:
          break
        case 429:
          vm.$notify('Error',
            'error',
            'Too many requests')
          break
        default:
      }
    }

    return Promise.reject(error)
  }
)
