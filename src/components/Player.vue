<template>
    <div class="container">
        <div class="row">
            <div class="col player mt-5 mb-5 d-flex justify-content-center">
                <div v-if="musica" class="card" style="width: 28rem;">
                    <img :src="require(`@/assets/imgs/${musica.imagem}.jpg`)" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ musica.musica }}</h5>
                        <p class="card-text">{{ musica.compositor }}</p>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <button @click="prev()" class="btn btn-back-next">
                                    <i class="fa-solid fa-backward"></i>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button @click="tocarMusica()" class="btn btn-play">
                                    <i class="fa-solid"
                                        :class="{ 'fa-play': !tocandoMusica, 'fa-pause': tocandoMusica }"></i>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button @click="next()" class="btn btn-back-next">
                                    <i class="fa-solid fa-forward"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <small class="me-3 mt-3">{{ formatoTempo(tempoAtual) }}</small>

                            <input type="range" class="form-range mt-3" min="0" :max="duracaoTotal" v-model="tempoAtual"
                                @input="alterarTempo" style="width: 100%; height: 3px; cursor: pointer;" />

                            <small class="ms-3 mt-3">{{ formatoTempo(duracaoTotal) }}</small>
                        </div>
                    </div>

                    <audio ref="audioElement" :src="getMusica()" preload="auto" autoplay
                        @timeupdate="atualizarTempo"></audio>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script lang="ts">

import { Options, Vue } from 'vue-class-component'
import { Musicas } from '@/utils/interfaces'
import axios from 'axios'

@Options({
    components: {

    },
})
export default class Player extends Vue {

    //configurações de áudio
    musica: Musicas | null = null
    audio: HTMLAudioElement | null = null
    tocandoMusica = false

    //configurações de tempo
    tempoAtual = 0
    duracaoTotal = 0

    //progressbar
    progresso = 0

    // Configurar um intervalo para atualizar regularmente o progresso
    progressInterval: number | null = null

    //ID do usuario autenticado
    usuario_id = localStorage.getItem('usuarioId')

    // Playlist
    playlist: Musicas[] = [] //acessar as músicas
    musicaAtualIndex = 0 // Inicializar com o índice da primeira música

    created() {

        //musica termina de tocar
        this.audio = this.$refs.audioElement as HTMLAudioElement

        if (this.audio) {
            this.audio.addEventListener('ended', () => {
                this.next()
                console.log('finalizou, proxima musica')
            })
        }

        // Receba o parâmetro 'id' da rota e converta-o em um número
        const id = Number(this.$route.params.id)

        // Verifique se id é um número válido
        if (!isNaN(id)) {
            // Chame o método para buscar detalhes da música com base no ID
            this.buscarDetalhesDaMusica(id)

            // Carregar a playlist do usuário
            this.carregarPlaylistUsuario()

        } else {
            console.error('ID ausente na rota ou não é um número.')
        }

        //começar tocando a música
        this.tocandoMusica = true

        // Iniciar o intervalo para atualizar o progresso
        this.progressInterval = setInterval(this.atualizarProgresso, 1000)

    }

    async carregarPlaylistUsuario() { //carregar playlist do usuário
        try {
            console.log('ID do usuário:', this.usuario_id)
            const res = await axios.get(
                'http://localhost/projetos/spotify_clone/src/backend/musicas_playlist_usuario.php',
                {
                    params: {
                        usuario_id: this.usuario_id,
                    },
                }
            )

            if (res.status === 200) {
                this.playlist = res.data // Assumindo que a resposta contém as músicas da playlist
                console.log('Playlist carregada:', this.playlist)
            } else {
                console.error('Erro ao carregar a playlist do usuário.')
            }
        } catch (error) {
            console.error('Erro ao carregar a playlist do usuário:', error)
        }
    }

    public atualizarTempo() { //atualizar tempo

        const audioElement = this.$refs.audioElement as HTMLAudioElement

        if (audioElement) {
            // Atualize o tempo atual e a duração total da música
            this.tempoAtual = audioElement.currentTime
            this.duracaoTotal = audioElement.duration
        }
    }

    public formatoTempo(tempo: number): string { //método para formatação do tempo minutos:segundos

        const minutos = Math.floor(tempo / 60)
        const segundos = Math.floor(tempo % 60)
        return `${minutos}:${segundos.toString().padStart(2, '0')}`

    }

    public atualizarProgresso() { // Método para atualizar a barra de progresso
        const audioElement = this.$refs.audioElement as HTMLAudioElement

        if (audioElement && !isNaN(audioElement.duration)) {
            this.progresso = (audioElement.currentTime / audioElement.duration) * 100
        } else {
            this.progresso = 0
        }
    }

    public alterarTempo() { //alterar tempo da barra
        const audioElement = this.$refs.audioElement as HTMLAudioElement

        if (audioElement) {
            audioElement.currentTime = this.tempoAtual
        }
    }

    public tocarMusica() { // Método para controlar a reprodução e a pausa da música

        const audioElement = this.$refs.audioElement as HTMLAudioElement

        if (audioElement.paused) {
            audioElement.play()
            this.tocandoMusica = true
        } else {
            audioElement.pause()
            this.tocandoMusica = false
        }

    }

    async buscarDetalhesDaMusica(id: number): Promise<Musicas | null> { //exibir detalhes da música
        try {
            const response = await axios.get(`http://localhost/projetos/spotify_clone/src/backend/musica_detalhes.php?id=${id}`)

            if (response.status === 200) {
                let musicaEncontrada = response.data

                // Faça a conversão de tipos para as propriedades que devem ser números
                musicaEncontrada.id = Number(musicaEncontrada.id)

                if (musicaEncontrada) {
                    this.musica = musicaEncontrada
                    return musicaEncontrada // Retorne a música encontrada
                } else {
                    console.error('Música não encontrada.')
                    this.musica = null
                    return null // Retorne null quando a música não for encontrada
                }
            } else {
                throw new Error('Erro ao buscar detalhes da música')
            }
        } catch (error) {
            console.error('Erro ao buscar detalhes da música:', error)
            throw error
        }
    }

    public prev() {
        if (this.playlist.length === 0) return

        if (this.musicaAtualIndex > 0) {
            this.musicaAtualIndex--
        } else {
            // Você pode optar por reiniciar a lista ou parar a reprodução no início.
            // Aqui, estamos reiniciando a lista.
            this.musicaAtualIndex = this.playlist.length - 1
        }

        this.playMusicaAtual()
    }

    public next() {
        if (this.playlist.length === 0) return

        if (this.musicaAtualIndex < this.playlist.length - 1) {
            this.musicaAtualIndex++
        } else {
            // Você pode optar por reiniciar a lista ou parar a reprodução no final.
            // Aqui, estamos reiniciando a lista.
            this.musicaAtualIndex = 0
        }

        this.playMusicaAtual()
    }

    playMusicaAtual() {
        if (this.playlist.length === 0) return

        const novaMusica = this.playlist[this.musicaAtualIndex]
        this.buscarDetalhesDaMusica(novaMusica.id)
        this.tocandoMusica = true
    }

    getMusica() { // Método para obter o caminho da música com base nos detalhes da música

        if (this.musica && this.musica.som) {
            return require(`@/assets/music/${this.musica.som}.mp3`)
        }
        return '' // Retorne um caminho vazio se os dados da música forem inválidos

    }
}
</script>
  
<style lang="scss">
@import '../scss/pagina_usuario.scss';
</style>