<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 musicas">
        <h2 class="mt-3">Playlist de {{ nomeUsuario }}</h2>
        <table class="table table-hover mt-5 mb-5 custom-table">
          <tbody>
            <tr v-for="(musica, index) in musicas" :key="index">
              <th scope="row">{{ index + 1 }}</th>
              <td><img class="img_musica img-fluid" :src="require(`@/assets/imgs/${musica.imagem}.jpg`)"></td>
              <td>{{ musica.musica }}</td>
              <td>{{ musica.compositor }}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <router-link :to="{ name: 'Player' }" class="btn btn-success"><i
                      class="fa-solid fa-play"></i></router-link>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-center">
                  <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import auth from '@/utils/auth'
import axios from 'axios'
import { Musicas } from '@/utils/interfaces'

@Options({
  components: {

  },
})
export default class Playlist extends Vue {

  musicas: Musicas[] = []

  created() {
    this.getMusicasSalvasUsuario()
  }

  public getMusicasSalvasUsuario() {
    const usuarioId = localStorage.getItem('usuarioId')

    if (usuarioId) {

      axios.get(`http://localhost/Projetos/spotify_clone/src/backend/musicas_usuario.php?usuario_id=${usuarioId}`)
        .then((res) => {
          if (res.data.status === 'sucesso') {
            this.musicas = res.data.musicas
          } else {
            console.error('Erro ao buscar músicas da playlist:', res.data.erro)
          }
        })
        .catch((error) => {
          console.error('Erro ao buscar músicas da playlist:', error)
        })

    }
  }

  get nomeUsuario() { //Nome do usuario autenticado
    return localStorage.getItem('usuarioNome') || auth.usuarioNome || ''
  }

}
</script>

<style lang="scss">
@import '../scss/pagina_usuario.scss';
</style>