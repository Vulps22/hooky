<template>
    <div>
      <RegistrationForm v-if="showRegistrationForm" @switch-to-login="showRegistrationForm = false" />
      <LoginForm v-else @switch-to-registration="showRegistrationForm = true" />
    </div>
  </template>
  
  <script lang="ts">
  import RegistrationForm from './register.vue';
  import LoginForm from './Login.vue';
  
  export default {
    components: {
      RegistrationForm,
      LoginForm,
    },
    data() {
      return {
        showRegistrationForm: true,
      };
    },
  };
  </script>
  