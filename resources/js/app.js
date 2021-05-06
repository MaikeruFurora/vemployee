require('./bootstrap');
window.Vue = require('vue');
Vue.component('app-component', require('./components/app.vue').default);
// import router
import router from './route'
import global from './global'
import VueProgressBar from 'vue-progressbar'
import CripNotice from 'crip-vue-notice'
import Multiselect from 'vue-multiselect'

  // register globally
Vue.component('multiselect', Multiselect)
Vue.use(CripNotice)
Vue.use(VueProgressBar, {
  color: 'rgb(3, 186, 252)',
  failedColor: 'red',
  height: '5px'
})
Vue.mixin(global)
let loggedIn = () => {
    return localStorage.getItem('token');
}
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (!loggedIn()) {
        next({
          path: '/',
          query: { redirect: to.fullPath }
        })
      } else {
        next()
      }
    } else  if (to.matched.some(record => record.meta.guest)) {
        if (loggedIn()) {
            next({
              path: '/dashboard',
              query: { redirect: to.fullPath }
            })
          } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
  })

const app = new Vue({
    el: '#app',
    router
});
