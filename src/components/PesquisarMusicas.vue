<template>
  <div class="container">
    <div class="row">
      <div class="col pesquisar_musicas text-center mt-3">
        <h2>Olá, Mateus. Seja bem vindo(a)</h2>
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
            <tr>
              <th scope="row">1</th>
              <td>The Lazy Song</td>
              <td>Bruno Mars</td>
              <td>
                <div class="d-flex justify-content-center">
                  <button class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>There's Nothing Hold me Back</td>
              <td>Shawn Mendes</td>
              <td>
                <div class="d-flex justify-content-center">
                  <button class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Miracle</td>
              <td>Calvin Harris, Ellie Goulding</td>
              <td>
                <div class="d-flex justify-content-center">
                  <button class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                </div>
              </td>
            </tr>

            <tr>
              <th scope="row">4</th>
              <td>This is What You Came For</td>
              <td>Calvin Harris, Rihanna</td>
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
import NavbarUsuario from '@/components/NavbarUsuario.vue'

@Options({
  components: {
    NavbarUsuario
  },
})
export default class PesquisarMusicas extends Vue {

}
</script>

<style lang="scss">
@import '../scss/pagina_usuario.scss';
</style>