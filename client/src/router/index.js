import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [

  {
    path: '',
    component: () => import('../layouts/Main.vue'),
    children: [
      {
        path: '/',
        name: 'dashboard',
        component: () => import('../views/Dashboard.vue'),
        meta: {
          pageTitle: 'Home'
        }
      },
      {
        path: '/news',
        name: 'news',
        component: () => import('../views/News.vue'),
        meta: {
          pageTitle: 'News'
        }
      },
      {
        path: '/account',
        name: 'account',
        component: () => import('../views/Account/Account.vue'),
        meta: {
          pageTitle: 'Profile'
        }
      },
      {
        path: '/product/:id',
        name: 'product',
        component: () => import('../views/Product/Product.vue'),
        meta: {
          pageTitle: 'Product'
        }
      }
      // {
      //   path: '/faq',
      //   name: 'faq',
      //   component: () => import("../views/support/FAQ.vue"),
      //   meta: {
      //     breadcrumb: [
      //       { title: 'Home', to: '/' },
      //       { title: 'faq', active: true },
      //     ],
      //     pageTitle: 'faq',
      //   }
      // },
    ]
  },
  {
    path: '',
    component: () => import('../layouts/Auth.vue'),
    children: [
      {
        path: '/register',
        name: 'register',
        component: () => import('../views/Auth/Register'),
        meta: {
          withoutAuth: true
        }
      },
      {
        path: '/login',
        name: 'login',
        component: () => import('../views/Auth/Login'),
        meta: {
          withoutAuth: true
        }
      },
      {
        path: '/logout',
        name: 'logout',
        component: () => import('../views/Auth/Logout'),
        meta: {
          withoutAuth: false
        }
      },
      {
        path: '/404',
        name: 'error-404',
        component: () => import('../views/Errors/Error404'),
        meta: {
          withoutAuth: true
        }
      },
      {
        path: '/403',
        name: 'error-403',
        component: () => import('../views/Errors/Error403'),
        meta: {
          withoutAuth: true
        }
      }
    ]
  },
  {
    path: '*',
    redirect: '/404',
    meta: {
      withoutAuth: true
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
  scrollBehavior () {
    return { x: 0, y: 0 }
  }
})

// router.beforeEach((to, from, next) => {
//
// });

export default router
