<template>
    <nav class="navbar navbar-expand-lg navbar-index bg-index">
        <div class="container-fluid">
            <router-link to="/pagina-usuario" class="navbar-brand">
                <span style="font-size: 30px;"><i class="fa-solid fa-user"></i> {{ nomeUsuario }}</span>
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link :class="{ active: $route.name === 'PesquisarMusicas' }"
                            :to="{ name: 'PesquisarMusicas' }" class="nav-link">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Pesquisar músicas
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :class="{ active: $route.name === 'Playlist' }" :to="{ name: 'Playlist' }"
                            class="nav-link">
                            <i class="fa-solid fa-list"></i> Playlist
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <button @click="fazerLogout()" class="btn btn-logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
  
<script lang="ts">

import { Options, Vue } from 'vue-class-component'
import auth from '@/utils/auth'

@Options({
    components: {

    },
})

export default class NavbarUsuario extends Vue {

    get nomeUsuario() {
        return localStorage.getItem('usuarioNome') || auth.usuarioNome || ''
    }

    public fazerLogout() {
        localStorage.removeItem('authToken')
        localStorage.removeItem('usuarioNome')
        auth.usuarioAutenticado = false
        auth.usuarioNome = ''
        this.$router.push('/')
    }

}

</script>

<style lang="scss">@import '../scss/navbars.scss';</style>