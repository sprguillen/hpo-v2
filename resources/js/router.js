import VueRouter from 'vue-router'
import Login from '@/pages/auth/Login'
import Dashboard from '@/pages/Dashboard'
import Clients from '@/pages/clients/Index'
import ClientDetails from '@/pages/clients/Details'
import Processors from '@/pages/Processors'
import Services from '@/pages/services/Index'
import ServiceDetails from '@/pages/services/Details'
import System from '@/pages/System'
import store from '@/store'
import NewPassword from '@/pages/auth/NewPassword'
import ResetPassword from '@/pages/auth/ResetPassword'

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
      path: '/clients',
      name: 'clients',
      component: Clients,
      meta: {
        requiresAuth: true,
        forAdmin: true
      }
    },
    {
      path: '/clients/:code',
      name: 'client_details',
      component: ClientDetails,
      meta: {
        requiresAuth: true,
        forAdmin: true
      }
    },
    {
      path: '/services',
      name: 'services',
      component: Services,
      meta: {
        requiresAuth: true,
        forAdmin: true
      }
    },
    {
      path: '/services/:code',
      name: 'service_details',
      component: ServiceDetails,
      meta: {
        requiresAuth: true,
        forAdmin: true
      }
    },
    {
      path: '/processors',
      name: 'processors',
      component: Processors,
      meta: {
        requiresAuth: true,
        forAdmin: true
      }
    },
    {
      path: '/system-configurations',
      name: 'system',
      component: System,
      meta: {
        requiresAuth: true,
        forAdmin: true
      }
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        guest: true
      }
    },
    {
      path: '/new-password',
      name: 'newPass',
      component: NewPassword,
      meta: {
        guest: true
      }
    },
    {
      path: '/reset-password',
      name: 'resetPass',
      component: ResetPassword,
      meta: {
        guest: true
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  let authToken = store.getters['auth/getAccessToken']
  let userRole = store.getters['auth/getUserRole']

  if (to.meta.requiresAuth) {
    if (!authToken || !userRole) {
      next({ path: '/login' })
    } else if (to.meta.forAdmin) {
      if (userRole == 10) {
        next()
      } else {
        next({ path: '/' })
      }
    } else {
      next()
    }
  } else if (to.meta.guest) {
    if (!authToken || !userRole) {
      next()
    } else {
      next({ path: '/' })
    }
  }
})

export default router