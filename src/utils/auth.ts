import { reactive } from 'vue'

interface AuthState {
  usuarioAutenticado: boolean
  authToken: string | null
  usuarioNome: string
}

const state: AuthState = reactive({
  usuarioAutenticado: !!localStorage.getItem('authToken'),
  authToken: localStorage.getItem('authToken') || null,
  usuarioNome: localStorage.getItem('usuarioNome') || ''
})

export default state