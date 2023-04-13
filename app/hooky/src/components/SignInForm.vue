<template>
    <div>
      <ProfileEditor v-if="showRegistrationForm && showProfileEditor" />
      <RegistrationForm v-else-if="showRegistrationForm" @switch-to-login="showRegistrationForm = false" @registered="showProfileEditor = true" />
      
      <LoginForm v-else @switch-to-registration="showRegistrationForm = true" @no-profile="showRegistrationForm = true; showProfileEditor = true"/>

    </div>
  </template>
  
  <script lang="ts">
  import RegistrationForm from './Register.vue';
  import LoginForm from './Login.vue';
  import ProfileEditor from './ProfileEditor.vue';

  export default {
    components: {
      RegistrationForm,
      LoginForm,
      ProfileEditor
    },
    data() {
      return {
        showRegistrationForm: true,
        showProfileEditor: false
      };
    },
  };
  </script>
  