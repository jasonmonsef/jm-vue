import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
//import About from './views/About.vue'


Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/jm-vue/',
      name: 'home',
      component: Home
    },
    {
      path: '/jm-vue/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    },
    {
      path: '/jm-vue/portfolio',
      name: 'portfolio',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/portfolio.vue')
    },
    {
      path: '/jm-vue/portfolio/:postSlug',
      name: 'portfolio-single',
      props: true,
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/portfolio-single.vue')
    }
  ],
  //make page scroll to top on rout change
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 }
  }
})
