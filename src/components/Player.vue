<template>
    <div class="container">
        <div class="row">
            <div class="col player mt-5 mb-5 d-flex justify-content-center">
                <div class="card" style="width: 28rem;">
                    <img src="../assets/imgs/m4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">This is What You Came For</h5>
                        <p class="card-text">Calvin Harris, Rihanna</p>

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

@Options({
    components: {

    },
})
export default class Player extends Vue {

}
</script>
  
<style lang="scss">
@import '../scss/pagina_usuario.scss';
</style>