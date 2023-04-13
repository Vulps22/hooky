<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'

</script>

<template data-bs-theme="dark">
    <Header />
    <br>
    <br>
    <router-view />
</template>

<script lang="ts">
import Header from "./components/Header.vue";

export default {
  components: {
    Header,
  },
};
</script>