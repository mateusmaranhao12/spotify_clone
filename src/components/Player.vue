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
                                <button class="btn btn-success">
                                    <i class="fa-solid fa-backward"></i>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button @click="tocarMusica()" class="btn btn-success">
                                    <i class="fa-solid"
                                        :class="{ 'fa-play': !tocandoMusica, 'fa-pause': tocandoMusica }"></i>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success">
                                    <i class="fa-solid fa-forward"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <small class="me-2 mt-3">0:58</small>
                            <div class="progress mt-3 flex-grow-1" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100">
                                <div class="progress-bar" style="width: 25%"></div>
                            </div>
                        </div>
                    </div>
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

    musica: Musicas | null = null
    audio: HTMLAudioElement | null = null
    tocandoMusica = false

    created() {
        // Receba o parâmetro 'id' da rota e converta-o em um número
        const id = Number(this.$route.params.id)

        // Verifique se id é um número válido
        if (!isNaN(id)) {
            // Chame o método para buscar detalhes da música com base no ID
            this.buscarDetalhesDaMusica(id)
        } else {
            console.error('ID ausente na rota ou não é um número.')
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

    tocarMusica() {
        if (!this.musica || !this.musica.som) {
            console.error('Dados da música ausentes ou inválidos.')
            return
        }

        if (!this.audio) {
            // Carregue a música dinamicamente com base no caminho da música
            const musicaPath = `@/assets/music/${this.musica.som}.mp3`
            this.audio = new Audio(musicaPath)

            this.audio.addEventListener('ended', () => {
                this.tocandoMusica = false;
            });
        }

        if (this.tocandoMusica) {
            this.audio.pause()
        } else {
            this.audio.play()
        }

        this.tocandoMusica = !this.tocandoMusica
    }
}
</script>
  
<style lang="scss">
@import '../scss/pagina_usuario.scss';
</style>