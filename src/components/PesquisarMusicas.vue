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

      <div v-if="mensagem_alerta" class="mt-3 text-center" :class="mensagem_alerta.status">
        {{ mensagem_alerta.mensagem }}
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
                  <button @click="adicionarMusicaPlaylist(musica.id)" class="btn btn-success"><i
                      class="fa-solid fa-plus"></i></button>
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
import { MensagemAlerta } from '@/utils/interfaces'


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

  mensagem_alerta: MensagemAlerta | null = null

  musicas: Musicas[] = []
  audioUrl = ''
  pesquisar_musica = ''
  usuario_id = localStorage.getItem('usuarioId')

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

  async adicionarMusicaPlaylist(musica_id: number) { //adicionar musica a playlist

    console.log('usuario_id:', this.usuario_id)
    console.log('musica_id:', musica_id)

    if (!this.usuario_id) {
      console.error('ID do usuário não encontrado em localStorage.')
      return
    }

    const config = {
      headers: {
        'Content-Type': 'application/json',
      },
    }

    try {
      const response = await axios.post(
        'http://localhost/Projetos/spotify_clone/src/backend/musicas_playlist.php',

        {
          usuario_id: this.usuario_id,
          musica_id: musica_id,
        },

        config
      )

      console.log('Resposta do servidor:', response)

      if (response.data.status === 'sucesso') {

        this.mensagem_alerta = {
          status: 'alert alert-success',
          mensagem: response.data.mensagem,
        }

      } else if (response.data.status === 'info') {

        this.mensagem_alerta = {
          status: 'alert alert-info',
          mensagem: response.data.mensagem
        }

      } else {
        this.mensagem_alerta = {
          status: 'alert alert-danger',
          mensagem: response.data.mensagem || 'Erro desconhecido ao adicionar música à playlist',
        }
      }

      setTimeout(() => {
        this.mensagem_alerta = { status: '', mensagem: '' }
      }, 5000)

    } catch (error) {

      console.error('Erro na solicitação:', error)
      this.mensagem_alerta = {
        status: 'alert alert-danger',
        mensagem: 'Erro na solicitação. Verifique o console para mais detalhes.',
      }
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