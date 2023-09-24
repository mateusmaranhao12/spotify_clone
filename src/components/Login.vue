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
              <form @submit.prevent="fazerLogin">
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
import auth from '@/utils/auth'


@Options({
  components: {
    NavbarIndex
  }
})

export default class Login extends Vue {

  usuarios_cadastrados = { email: '', senha: '' }
  mostrar_senha = false
  senha = ''
  mensagem_erro_login = ''

  public async fazerLogin() {

    const formData = new FormData()
    formData.append('email', this.usuarios_cadastrados.email)
    formData.append('senha', this.usuarios_cadastrados.senha)

    try {
      const response = await axios.post(
        'http://localhost/projetos/spotify_clone/src/backend/login.php',
        formData
      )

      const data = response.data
      console.log('Dados do servidor após login:', data)

      if (data.status === 'sucesso') {

        console.log('ID do usuário:', data.id)
        auth.usuarioAutenticado = true
        auth.usuarioNome = data.nome
        localStorage.setItem('usuarioNome', data.nome)
        localStorage.setItem('usuarioId', data.id)
        localStorage.setItem('authToken', data.authToken)

        // Redirecionar para a rota após as atualizações
        this.$router.push('/pagina-usuario')

      } else if (data.status === 'erro') {

        this.mensagem_erro_login = data.mensagem
        setTimeout(() => {
          this.mensagem_erro_login = ''
        }, 5000)

      }
    } catch (error) {

      console.error('Erro ao fazer login:', error)
      this.mensagem_erro_login = 'Ocorreu um erro ao fazer login.'

    }
  }

  public alternarExibicaoSenha() {
    this.mostrar_senha = !this.mostrar_senha
  }
}
</script>
  
<style lang="scss">
@import '../scss/forms.scss';
@import '../scss/alerts.scss';
</style>