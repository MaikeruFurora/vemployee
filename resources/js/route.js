import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
//import all page or components
import login from './components/auth/login'
import dashboard from './components/admin/pages/dashboard'
import teachers from './components/admin/pages/teachers'
import record from './components/admin/pages/record'
import lawop from './components/admin/pages/lawop'
import PageNotFound from './components/auth/pageNotFound'
const routes = [
    {
        
        path: '/',
        component: login,
        meta: { guest: true }
    },
    {
        path: '/dashboard',
        component: dashboard,
        meta: { requiresAuth: true }
    },
    {
        path: '/teachers',
        component: teachers,
        meta: { requiresAuth: true }
    },
    {
        name:'record',
        path: '/record',
        component: record,
        meta: { requiresAuth: true },
        props: true
    },
    {
        path: '/lawop',
        component: lawop,
        meta: { requiresAuth: true }
    },
    {
        path: "*",
        component: PageNotFound
    }
]

export default new Router({
    mode: 'history',
    routes
});