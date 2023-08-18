<template>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <router-link to="/" class="navbar-brand"><img class="img-fluid" src="../assets/imgs/logo.png" /> <span>Spotify</span></router-link>
                </div>
                <div class="col-md-2">
                    <h4>Empresa</h4>
                    <a href="">Sobre</a><br>
                    <a href="">Empregos</a>
                </div>
                <div class="col-md-2">
                    <h4>Comunidades</h4>
                    <a href="">Para artistas</a><br>
                    <a href="">Desenvolvedores</a>
                </div>
                <div class="col-md-2">
                    <h4>Links úteis</h4>
                    <a href="">Suporte</a><br>
                    <a href="">Player da web</a>
                </div>
                <div class="col-md-3">
                    <h4>Redes Sociais</h4>
                    <a href="">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>
  
<script lang="ts">
import { Options, Vue } from 'vue-class-component'

@Options({
    components: {

    },
})
export default class Footer extends Vue { }
</script>

<style lang="scss">
@import '../scss/footer.scss';
</style>
  