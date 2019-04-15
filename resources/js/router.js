import VueRouter from 'vue-router'
import Login from '@/pages/auth/Login'
import Dashboard from '@/pages/Dashboard'
import store from '@/store'

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        guest: true
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  let authToken = store.getters['auth/getAccessToken']

  console.log(authToken)
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!authToken) {
      next({ path: '/login' })
    } else {
      next()
    }
  } else if(to.matched.some(record => record.meta.guest)) {
    if (!authToken) {
      next()
    } else {
      next({ path: '/' })
    }
  }
})

export default router