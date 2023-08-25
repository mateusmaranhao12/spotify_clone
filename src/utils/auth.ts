import { reactive } from 'vue'

const state = reactive({
    usuarioAutenticado: !!localStorage.getItem('authToken'),
    authToken: localStorage.getItem('authToken') || null,
})

export default state