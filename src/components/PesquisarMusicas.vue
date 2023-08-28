<template>
  <div class="container">
    <div class="row">
      <div class="col pesquisar_musicas text-center mt-3">
        <h2>Olá, {{ nomeUsuario }}. Seja bem vindo(a)</h2>
        <h6>Encontre e salve suas músicas favoritas aqui no Spotify!</h6>
        <div class="col-md-12 d-flex">
          <input v-model="pesquisar_musica" type="text" class="white-text form-control me-2 mt-2"
            placeholder="Pesquisar música (Ex: The Lazy Song)">
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
              <td>
                <div class="d-flex justify-content-center">
                  <button class="btn btn-primary" @click="demonstrarMusica(musica)">
                    <i
                      :class="{ 'fa-solid fa-play': !musica.demonstrando, 'fa-solid fa-pause': musica.demonstrando }"></i>
                  </button>
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

  watch: {
    pesquisar_musica(newVal) {
      this.pesquisarMusica()
    }
  },
})

export default class PesquisarMusicas extends Vue {

  musicas: Musicas[] = []
  audioUrl = ''
  pesquisar_musica = ''

  created() { //exibir musicas
    this.getMusicas()
    this.audioElement = new Audio()
  }

  audioElement: HTMLAudioElement | null = null

  public getMusicas() { //visualizar musicas

    axios.get<Musicas[]>('http://localhost/Projetos/spotify_clone/src/backend/musicas.php')
      .then((res) => {
        this.musicas = res.data.map((musica) => ({
          ...musica,
          demonstrando: false,
        }))
      })
      .catch((err) => {
        console.error(err)
      })

  }

  public demonstrarMusica(musica: Musicas) { //demonstrar musica

    this.musicas.forEach((m) => {
      if (m === musica) {
        m.demonstrando = !m.demonstrando
        if (m.demonstrando) {
          this.audioElement!.src = require(`../assets/music/${musica.som}.mp3`)
          this.audioElement!.play()
        } else {
          this.audioElement!.pause()
        }
      } else {
        m.demonstrando = false
      }
    })

  }

  public pesquisarMusica() { //pesquisar musica

    if (this.pesquisar_musica.trim() === '') {
      this.getMusicas()
    } else {
      const pesquisarMusicaLowerCase = this.pesquisar_musica.toLowerCase()

      axios
        .get<Musicas[]>(`http://localhost/Projetos/spotify_clone/src/backend/musicas.php?pesquisa=${this.pesquisar_musica}`)
        .then((res) => {
          this.musicas = res.data.map((musica) => ({
            ...musica,
            demonstrando: false,
          }))

          // Filtre a lista baseada na pesquisa
          this.musicas = this.musicas.filter((musica) => {
            return musica.musica.toLowerCase().includes(pesquisarMusicaLowerCase)
          })
        })
        .catch((err) => {
          console.error(err)
        })
    }

  }

  get nomeUsuario() { //mostrar nome de usuario
    return localStorage.getItem('usuarioNome') || auth.usuarioNome || ''
  }

}
</script>

<style lang="scss">
@import '../scss/pagina_usuario.scss';
</style>