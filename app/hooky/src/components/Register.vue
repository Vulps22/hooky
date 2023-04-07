<template>
    <div class="container my-4 registration-container">
      <h1>Registration Form</h1>
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
        <div class="mb-3">
          <label for="confirm-password" class="form-label">Confirm Password</label>
          <input v-model="confirmPassword" type="password" class="form-control" id="confirm-password">
        </div>
        <div class="mb-3">
          <label for="dob" class="form-label">Date of Birth</label>
          <input v-model="dob" type="date" class="form-control" id="dob">
        </div>
        <div class="form-check">
          <input v-model="terms_accepted" class="form-check-input" type="checkbox" value="" id="accept">
          <label class="form-check-label" for="accept">
            I accept the T&amp;C's and the Privacy Policy
          </label>
        </div>
        <button :disabled="isUnderage" type="submit" class="btn btn-primary">Submit</button>
        <p>Already registered? <a href="#" @click="switchToLogin">Sign in</a> instead.</p>
      </form>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent } from 'vue';
  import API from '@/api';

  
  export default defineComponent({
    name: 'RegistrationForm',
    data() {
      return {
        email: '',
        password: '',
        confirmPassword: '',
        dob: '',
        terms_accepted: false,
      };
    },
    computed: {
      isUnderage() {
        const today = new Date();
        const birthDate = new Date(this.dob);
        let age = today.getFullYear() - birthDate.getFullYear();
        const month = today.getMonth() - birthDate.getMonth();
        if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
          age--;
        }
        return age < 18;
      },
    },
    methods: {
      submitForm() {
        if (this.isUnderage) {
          alert('You must be 18 to use this app');
          return;
        }
        
        const formData = {
            email: this.email,
            password: this.password,
            dob: this.dob,
            terms_accepted: this.terms_accepted,
        };

        API.user.register(formData, (data: any) => {
            console.log(data);
        }, (error: any) => {
            alert("Registration Failed");
            console.log(error.message);
        });
      },
    switchToLogin() {
      this.$emit('switch-to-login');
     },
    },
  });
  </script>
  
  <style>
  .registration-container {
    background-color: rgba(70, 70, 70, 0.5); /* white with 50% transparency */
    padding: 2rem; /* add some padding to create some space around the form */
    border-radius: 1rem; /* round the corners of the container */
    box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2); /* add a subtle shadow to create depth */
  }
  </style>
  