import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'

//Configurações de proteção de rotas
import { requerAutorizacao } from '@/utils/auth-guard'

//rotas iniciais
import Cadastro from '@/components/Cadastro.vue'
import Index from '@/views/Index.vue'
import Login from '@/components/Login.vue'

//rotas com acesso permitido somente se o usuário estiver autenticado
import PaginaUsuario from '@/views/PaginaUsuario.vue'
import PesquisarMusicas from '@/components/PesquisarMusicas.vue'
import Playlist from '@/components/Playlist.vue'
import Player from '@/components/Player.vue'

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
  },



  {
    path: '/pagina-usuario',
    name: 'PaginaUsuario',
    component: PaginaUsuario,
    redirect: '/pagina-usuario/pesquisar-musicas',
    beforeEnter: requerAutorizacao,

    children: [

      {
        path: 'pesquisar-musicas',
        name: 'PesquisarMusicas',
        component: PesquisarMusicas
      },

      {
        path: 'playlist',
        name: 'Playlist',
        component: Playlist
      },

      {
        path: 'player',
        name: 'Player',
        component: Player
      }

    ]
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
