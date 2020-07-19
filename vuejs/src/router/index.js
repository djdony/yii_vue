import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from "../views/Index"
import Home from "../views/Home"
import Register from "../components/Register"
import Login from "../components/Login"
import ForgotPassword from "../components/ForgotPassword"

Vue.use(VueRouter)

  const routes = [
  { path: '/',                  name: 'index',          component: Index,     },
  { path: '/home',              name: 'home',           component: Home,    meta: {isAuth: true}  },
  { path: '/register',          name: 'signup',         component: Register     },
  { path: '/login',             name: 'login',          component: Login        },
  { path: '/forgot-password',   name: 'forgot-password',component: ForgotPassword }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.isAuth)) {
        if (localStorage.getItem('access_token') == null) {
            next({
                path: '/login',
                params: { nextUrl: to.fullPath }
            })
        } else {
            let user = JSON.parse(localStorage.getItem('user'))
            if(to.matched.some(record => record.meta.is_admin)) {
                if(user.is_admin == 1){
                    next()
                }
                else{
                    next({ name: 'userboard'})
                }
            }else {
                next()
            }
        }
    } else if(to.matched.some(record => record.meta.guest)) {
        if(localStorage.getItem('access_token') == null){
            next()
        }
        else{
            next({ name: 'userboard'})
        }
    }else {
        next()
    }
})
export default router