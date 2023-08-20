<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 musicas">
        <h2 class="mt-3">Minha Playlist</h2>
        <table class="table table-hover mt-5 mb-5 custom-table">
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td><img class="img_musica img-fluid" src="../assets/imgs/m2.jpg"></td>
              <td>The Lazy Song</td>
              <td>Bruno Mars</td>
              <td>
                <div class="d-flex justify-content-center">
                  <router-link :to="{name: 'Player'}" class="btn btn-success"><i class="fa-solid fa-play"></i></router-link>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-center">
                  <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td><img class="img_musica img-fluid" src="../assets/imgs/m12.jpg"></td>
              <td>There's Nothing Hold me Back</td>
              <td>Shawn Mendes</td>
              <td>
                <div class="d-flex justify-content-center">
                  <router-link :to="{name: 'Player'}" class="btn btn-success"><i class="fa-solid fa-play"></i></router-link>
                </div>
              </td>
              <td>
                <div class="d-flex justify-content-center">
                  <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td><img class="img_musica img-fluid" src="../assets/imgs/m4.jpg"></td>
              <td>This is What You Came For</td>
              <td>Calvin Harris, Rihanna</td>
              <td>
                <div class="d-flex justify-content-center">
                  <router-link :to="{name: 'Player'}" class="btn btn-success"><i class="fa-solid fa-play"></i></router-link>
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

@Options({
  components: {

  },
})
export default class Playlist extends Vue {

}
</script>

<style lang="scss">
@import '../scss/pagina_usuario.scss';
</style>