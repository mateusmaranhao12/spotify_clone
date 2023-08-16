<template>
    <div class="login">
      <navbar-index />
      <h1>Login</h1>
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
  export default class Login extends Vue {}
  </script>
  