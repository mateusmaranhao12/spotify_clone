<template>
  <div class="home">
    <navbar-index />
    <div class="secao1">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h1>Músicas na melhor qualidade, você encontra aqui no Spotify!</h1>
          </div>
          <div class="col-md-6">
            <img class="img-fluid" src="../assets/imgs/img1.png" />
          </div>
        </div>
      </div>
    </div>
    <div class="secao2">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Músicas de todos os gêneros</h1>
          </div>
          <div v-for="g in genero" :key="g" class="col-md-3">
            <h3>{{ g }}</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="secao3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Curta ao som dos melhores artistas</h1>
          </div>
          <div  v-for="artista in artistas" :key="artista.nome" class="col-md-3">
            <h3>{{ artista.nome }}</h3>
            <img class="img-fluid" :src="require(`../assets/imgs/${artista.imagem}.jpg`)" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component'
import NavbarIndex from '@/components/NavbarIndex.vue'

@Options({
  components: {
    NavbarIndex
  },
})
export default class Index extends Vue {

  genero = ['Hip Hop', 'Pop', 'Rock', 'Rap', 'Indie', 'Sertanejo', 'MPB', 'K-Pop']

  artistas = [

    { nome: 'Bruno Mars', imagem: 'bruno_mars' },
    { nome: 'Calvin Harris', imagem: 'calvin_harris' },
    { nome: 'Rihanna', imagem: 'rihanna' },
    { nome: 'Shawn Mendes', imagem: 'shawn_mendes' }

  ]

}
</script>

<style lang="scss">
@import '../scss/index.scss';
</style>