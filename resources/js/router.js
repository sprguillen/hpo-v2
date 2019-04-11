import VueRouter from 'vue-router'
import Login from './components/auth/Login'
import MainComponent from './components/MainComponent'
import { getCookie } from './utils/cookies'

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: MainComponent
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    }
  ]
})

router.beforeEach((to, from, next) => {
  let authToken = getCookie('auth')
  if (!authToken && to.name !== 'login') {
    return next('/login')
  }

  next()
})

export default router