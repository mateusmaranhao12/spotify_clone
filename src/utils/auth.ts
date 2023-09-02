import { reactive } from 'vue'

interface AuthState {
  usuarioAutenticado: boolean
  authToken: string | null
  usuarioNome: string
  usuarioId: number | null
}

const state: AuthState = reactive({
  usuarioAutenticado: !!localStorage.getItem('authToken'),
  authToken: localStorage.getItem('authToken') || null,
  usuarioNome: localStorage.getItem('usuarioNome') || '',
  usuarioId: localStorage.getItem('usuarioId') ? parseInt(localStorage.getItem('usuarioId')!) : null
})

export default state