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
          <div class="col-md-3">
            <h3>Pop</h3>
          </div>
          <div class="col-md-3">
            <h3>Hip Hop</h3>
          </div>
          <div class="col-md-3">
            <h3>Trap</h3>
          </div>
          <div class="col-md-3">
            <h3>Rap</h3>
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
          <div class="col-md-3">
            <img class="img-fluid" src="../assets/imgs/bruno_mars.jpg" />
            <h3>Bruno Mars</h3>
          </div>
          <div class="col-md-3">
            <img class="img-fluid" src="../assets/imgs/calvin_harris.jpg" />
            <h3>Calvin Harris</h3>
          </div>
          <div class="col-md-3">
            <img class="img-fluid" src="../assets/imgs/rihanna.jpg" />
            <h3>Rihanna</h3>
          </div>
          <div class="col-md-3">
            <img class="img-fluid" src="../assets/imgs/shawn_mendes.jpg" />
            <h3>Shawn Mendes</h3>
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
export default class Index extends Vue { }
</script>

<style lang="scss">
@import '../scss/index.scss';
</style>