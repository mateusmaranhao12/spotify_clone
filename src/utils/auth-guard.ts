import { NavigationGuardNext, RouteLocationNormalized } from 'vue-router'
import auth from '@/utils/auth'

export function requerAutorizacao(to: RouteLocationNormalized, from: RouteLocationNormalized, next: NavigationGuardNext) {

    if (auth.authToken) {
        next() // Permite o acesso à rota
    } else {
        next('/login') // Redireciona para a página de login se não estiver autenticado
    }
}