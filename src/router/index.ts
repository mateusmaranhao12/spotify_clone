import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'

import Cadastro from '@/components/Cadastro.vue'
import Index from '@/views/Index.vue'
import Login from '@/components/Login.vue'

const routes: Array<RouteRecordRaw> = [

  {
    path: '/',
    name: 'Index',
    component: Index
  },

  {
    path: '/cadastro',
    name: 'Cadastro',
    component: Cadastro
  },

  {
    path: '/login',
    name: 'Login',
    component: Login
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
