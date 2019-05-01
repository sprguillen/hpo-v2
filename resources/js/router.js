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
        requiresAuth: true
      }
    },
    {
      path: '/clients/:id',
      name: 'client_details',
      component: ClientDetails,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/services',
      name: 'services',
      component: Services,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/services/:id',
      name: 'service_details',
      component: ServiceDetails,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/processors',
      name: 'processors',
      component: Processors,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/system-configurations',
      name: 'system',
      component: System,
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