import VueRouter from 'vue-router'
import Login from './components/auth/Login'
import MainComponent from './components/MainComponent'
console.log('test')

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: MainComponent
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    }
  ],
});

// router.beforeEach((to, from, next) => {
//   next({ path: '/login' })
// })

export default router