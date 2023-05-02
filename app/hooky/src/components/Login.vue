<template>
  <div class="container my-4 login-container">
    <h1>Login Form</h1>
    <form @submit.prevent="submitForm">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input v-model="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input v-model="password" type="password" class="form-control" id="password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <p>Not registered? <a href="#" @click="switchToRegistration">Click here</a> to register.</p>
    </form>
  </div>
</template>

<script lang="ts">
import API from '@/api';
import { defineComponent } from 'vue';
import { useUserStore } from '@/stores/user';

export default defineComponent({
  name: 'LoginForm',
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    submitForm() {
      const formData = {
        email: this.email,
        password: this.password
      };
      API.user.login(formData, (data: any) => {
        console.log(data);
        const userStore = useUserStore();
        userStore.setUser(data);
        if(!data.profile) this.$emit("no-profile");
        else this.$router.push('/home');
      },
      (err: any) => {
        console.log(err);
      })
    },
    switchToRegistration() {
      this.$emit('switch-to-registration');
    },
  },
});
</script>

<style>
.login-container {
  background-color: rgba(70, 70, 70, 0.5); /* white with 50% transparency */
  padding: 2rem; /* add some padding to create some space around the form */
  border-radius: 1rem; /* round the corners of the container */
  box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2); /* add a subtle shadow to create depth */
}
</style>
