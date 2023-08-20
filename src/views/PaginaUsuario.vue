<template>
    <navbar-usuario></navbar-usuario>
    <router-view></router-view>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import NavbarUsuario from '@/components/NavbarUsuario.vue'

@Options({
  components: {
    NavbarUsuario
  },
})
export default class PaginaUsuario extends Vue {

}
</script>