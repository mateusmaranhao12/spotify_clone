<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 musicas">
        <h2 class="mt-3">Playlist de {{ nomeUsuario }}</h2>

        <div v-if="mensagem_alerta" class="mt-3 text-center" :class="mensagem_alerta.status">
          {{ mensagem_alerta.mensagem }}
        </div>

        <table class="table table-hover mt-5 mb-5 custom-table">

          <div v-if="musicas.length === 0" class="alert alert-secondary" role="alert">
            <!--Se o usuário não adicionou nenhuma música-->
            Você ainda não salvou músicas em sua playlist.
          </div>

          <tbody>
            <tr v-for="(musica, index) in musicas" :key="index">
              <th scope="row">{{ index + 1 }}</th>
              <td><img class="img_musica img-fluid" :src="require(`@/assets/imgs/${musica.imagem}.jpg`)"></td>
              <td>{{ musica.musica }}</td>
              <td>{{ musica.compositor }}</td>
              <td>
                <div class="d-flex justify-content-center">
                  <router-link :to="{ name: 'Player', params: { musica: JSON.stringify(musica) } }"
                    class="btn btn-success"><i class="fa-solid fa-play"></i></router-link>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-center">
                  <button @click="removerMusicaPlaylist(musica.id)" class="btn btn-danger"><i
                      class="fa-solid fa-trash"></i></button>
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
})
export default class Playlist extends Vue {

  mensagem_alerta: MensagemAlerta | null = null

  musicas: Musicas[] = []

  created() { //acionar o metodo de exibir as musicas
    this.getMusicasSalvasUsuario()
  }

  public getMusicasSalvasUsuario() { //exibir musicas do usuario
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

  public async removerMusicaPlaylist(musicaId: number) { //remover musica da playlist do usuario
    const usuarioId = localStorage.getItem('usuarioId')

    if (!usuarioId) {
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
        'http://localhost/Projetos/spotify_clone/src/backend/remover_musica_playlist.php', // URL da sua rota para remoção
        {
          usuario_id: usuarioId,
          musica_id: musicaId,
        },
        config
      )

      if (response.data.status === 'sucesso') {

        // Música removida com sucesso
        this.mensagem_alerta = {
          status: 'alert alert-success',
          mensagem: response.data.mensagem,
        }

        this.getMusicasSalvasUsuario()

      } else {

        console.error('Erro ao remover música da playlist:', response.data.mensagem)
        this.mensagem_alerta = {
          status: 'alert alert-danger',
          mensagem: response.data.mensagem,
        }

      }

      setTimeout(() => {
        this.mensagem_alerta = { status: '', mensagem: '' }
      }, 5000)

    } catch (error) {
      console.error('Erro na solicitação:', error)
      // Trate o erro de rede ou outros erros aqui
    }
  }

  get nomeUsuario() { //Nome do usuario autenticado
    return localStorage.getItem('usuarioNome') || auth.usuarioNome || ''
  }

}
</script>

<style lang="scss">
@import '../scss/pagina_usuario.scss';
@import '../scss/alerts.scss';
</style>