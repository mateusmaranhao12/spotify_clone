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
                                <i class="fa-solid fa-backward"></i>
                            </div>
                            <div class="col-md-4">
                                <i class="fa-solid fa-pause"></i>
                            </div>
                            <div class="col-md-4">
                                <i class="fa-solid fa-forward"></i>
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

@Options({
    components: {

    },
})
export default class Player extends Vue {
    musica: Musicas | null = null

    created() {
        // Receba o parâmetro 'musica' da rota
        const musicaParam = this.$route.params.musica

        // Verifique se 'musicaParam' não está vazio e se é uma string
        if (typeof musicaParam === 'string') {
            // Converte a string JSON de volta para um objeto
            this.musica = JSON.parse(musicaParam)
            console.log('Dados da música:', this.musica)
        }
    }
}
</script>
  
<style lang="scss">
@import '../scss/pagina_usuario.scss';

</style>