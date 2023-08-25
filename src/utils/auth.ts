import { reactive } from "vue"

const state = reactive({
    authToken: localStorage.getItem('authToken') || null, // Obter o token armazenado
    usuarioAutenticado: false
})

export default state