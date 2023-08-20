<template>
  <div class="app-view">
    <router-view />
  </div>
</template>

<style lang="scss">
.app-view {
  background-color: rgb(22, 22, 22);
  /* Cor cinza */
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

body::-webkit-scrollbar {
  width: 12px;
  /* width of the entire scrollbar */
}

body::-webkit-scrollbar-track {
  background: #000;
  /* color of the tracking area */
}

body::-webkit-scrollbar-thumb {
  background-color: #1ED760;
  /* color of the scroll thumb */
  border-radius: 20px;
  /* roundness of the scroll thumb */
  border: 3px solid #000;
  /* creates padding around scroll thumb */
}</style>