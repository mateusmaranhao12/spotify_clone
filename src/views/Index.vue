<template>
  <div class="home">
    <navbar-index />
    <h1>Index</h1>
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
export default class Index extends Vue {}
</script>
