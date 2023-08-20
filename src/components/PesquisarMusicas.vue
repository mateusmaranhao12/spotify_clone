<template>
    <h1>Pesquisar músicas</h1>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import NavbarUsuario from '@/components/NavbarUsuario.vue'

@Options({
  components: {
    NavbarUsuario
  },
})
export default class PesquisarMusicas extends Vue {

}
</script>