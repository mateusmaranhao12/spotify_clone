<template>
  <div class="login">
    <navbar-index />
    <div class="login d-flex justify-content-center">
      <div class="card mx-auto mt-5 mb-3">
        <div class="card-body">
          <h3 class="card-title mb-5">Faça Login agora mesmo!</h3>
          <div class="container">
            <div class="row">
              <form>
                <div class="form-group">
                  <label for="email">E-mail <span class="text-danger">*</span> </label>
                  <input type="text" ref="email" placeholder="e-mail" id="email" class="form-control mb-3 white-text" name="email" />
                </div>

                <div class="form-group">
                  <label for="senha">Senha <span class="text-danger">*</span></label>
                  <div class="input-group mb-3">
                    <input :type="mostrar_senha ? 'text' : 'password'" class="form-control white-text" placeholder="Senha"
                      name="senha" aria-label="Senha" aria-describedby="button-addon2">
                    <button @click="alternarExibicaoSenha()" class="btn btn-outline-success" type="button" id="senha">
                      <i class="fa-solid" :class="{ 'fa-eye-slash': mostrar_senha, 'fa-eye': !mostrar_senha }"></i>
                    </button>
                  </div>
                </div>

                <div class="form-row mt-4 mb-4 text-center">
                  <div class="form-group col-md-12 d-flex justify-content-end">
                    <button class="btn btn-success mt-3" @click="fazerLogin()">Fazer login</button>
                  </div>
                </div>

                <div class="form-row mt-4 text-center">
                  <small>Ainda não tem conta? <router-link class="text-success" to="/cadastro">Cadastre-se</router-link>
                    agora mesmo!</small>
                </div>
              </form>
            </div>
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
export default class Login extends Vue {

  mostrar_senha = false
  senha = ''

  public fazerLogin() {
    this.$router.push('/pagina-usuario')
  }

  public alternarExibicaoSenha() {
    this.mostrar_senha = !this.mostrar_senha
  }

}
</script>
  
<style lang="scss">
@import '../scss/forms.scss';
</style>