<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'

</script>

<template data-bs-theme="dark">
    <Header />
    <br>
    <br>
    <div id="app-base">
      <div>
        <NavBar />
      </div>
      <div>
        <router-view />
      </div>
    </div>
</template>

<script lang="ts">
import Header from "./components/Header.vue";
import NavBar from './components/NavBar.vue';

export default {
  components: {
    Header,
    NavBar,
  },
};
</script>