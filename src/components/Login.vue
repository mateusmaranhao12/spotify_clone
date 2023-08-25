<template>
  <div class="login">
    <navbar-index />
    <div class="login d-flex justify-content-center">
      <div class="card mx-auto mt-5 mb-3">
        <div class="card-body">
          <h3 class="card-title mb-5">Faça Login agora mesmo!</h3>
          <div v-if="mensagem_erro_login" class="alert alert-danger text-center">
            {{ mensagem_erro_login }}
          </div>
          <div class="container">
            <div class="row">
              <form>
                <div class="form-group">
                  <label for="email">E-mail <span class="text-danger">*</span> </label>
                  <input v-model="usuarios_cadastrados.email" type="text" ref="email" placeholder="e-mail" id="email"
                    class="form-control mb-3 white-text" name="email" />
                </div>

                <div class="form-group">
                  <label for="senha">Senha <span class="text-danger">*</span></label>
                  <div class="input-group mb-3">
                    <input v-model="usuarios_cadastrados.senha" :type="mostrar_senha ? 'text' : 'password'"
                      class="form-control white-text" placeholder="Senha" name="senha" aria-label="Senha"
                      aria-describedby="button-addon2">
                    <button @click="alternarExibicaoSenha()" class="btn btn-outline-success" type="button" id="senha">
                      <i class="fa-solid" :class="{ 'fa-eye-slash': mostrar_senha, 'fa-eye': !mostrar_senha }"></i>
                    </button>
                  </div>
                </div>

                <div class="form-row mt-4 mb-4 text-center">
                  <div class="form-group col-md-12 d-flex justify-content-end">
                    <button class="btn btn-success mt-3" @click.prevent="fazerLogin()">Fazer login</button>
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
import axios from 'axios'

@Options({
  components: {
    NavbarIndex
  },
})
export default class Login extends Vue {

  usuarios_cadastrados = { email: '', senha: '' }
  mostrar_senha = false
  senha = ''
  mensagem_erro_login = ''

  public fazerLogin() { //fazer login

    const formData = new FormData()
    formData.append('email', this.usuarios_cadastrados.email) //verificar o email
    formData.append('senha', this.usuarios_cadastrados.senha) //verificar a senha

    axios.post('http://localhost/projetos/spotify_clone/src/backend/login.php', formData)

      .then(response => {

        const data = response.data
        if (data.status === 'sucesso') {
          this.$router.push('/pagina-usuario') //se as credenciais forem corretas, ir para a proxima rota
        } else if (data.status === 'erro') {

          this.mensagem_erro_login = data.mensagem //se nao, exibir mensagem de erro

          setTimeout(() => {
            this.mensagem_erro_login = '' //exibir a mensagem de erro somente por 5 segundos
          }, 5000)
        }

      })

      .catch(error => {
        console.error('Erro ao fazer login:', error)
        this.mensagem_erro_login = 'Ocorreu um erro ao fazer login.'

      })

  }

  public alternarExibicaoSenha() {
    this.mostrar_senha = !this.mostrar_senha
  }

}
</script>
  
<style lang="scss">
@import '../scss/forms.scss';
</style>