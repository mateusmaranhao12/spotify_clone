<template>
    <h1>Playlist</h1>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import NavbarUsuario from '@/components/NavbarUsuario.vue'

@Options({
  components: {
    NavbarUsuario
  },
})
export default class Playlist extends Vue {

}
</script>