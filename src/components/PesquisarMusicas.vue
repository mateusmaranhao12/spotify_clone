<template>
  <div class="container">
    <div class="row">
      <div class="col pesquisar_musicas text-center mt-3">
        <h2>Olá, {{ nomeUsuario }}. Seja bem vindo(a)</h2>
        <h6>Encontre e salve suas músicas favoritas aqui no Spotify!</h6>
        <div class="col-md-12 d-flex">
          <input type="text" class="white-text form-control me-2 mt-2" placeholder="Pesquisar música (Ex: The Lazy Song)">
          <button class="btn btn-success mt-2" type="button"><i class="fa-solid fa-magnifying-glass"></i>
            Pesquisar</button>
        </div>
      </div>

      <div class="col-md-12 musicas">
        <table class="table table-hover mt-5 mb-5 custom-table">
          <tbody>
            <tr v-for="musica in musicas" :key="musica.id">
              <th scope="row">{{ musica.id }}</th>
              <td><img class="img_musica img-fluid" :src="require(`../assets/imgs/${musica.imagem}.jpg`)"></td>
              <td>{{ musica.musica }}</td>
              <td>{{ musica.compositor }}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <button class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
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
export default class PesquisarMusicas extends Vue {

  musicas: Musicas[] = []

  created() {
    this.getMusicas()
  }

  public getMusicas() {

    axios.get<Musicas[]>('http://localhost/Projetos/spotify_clone/src/backend/musicas.php')
      .then((res) => {
        this.musicas = res.data
      })
      .catch((err) => {
        console.error(err)
      })

  }

  get nomeUsuario() {
    return localStorage.getItem('usuarioNome') || auth.usuarioNome || ''
  }

}
</script>

<style lang="scss">
@import '../scss/pagina_usuario.scss';
</style>