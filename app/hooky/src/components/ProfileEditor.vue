<template>
    <div class="container my-4">
      <h1>Profile Editor</h1>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="display-name" class="form-label">Display Name</label>
          <input v-model="displayName" type="text" class="form-control" id="display-name">
        </div>
        <div class="mb-3">
          <label for="bio" class="form-label">Bio</label>
          <textarea v-model="bio" class="form-control" id="bio" rows="3"></textarea>
        </div>
        <div class="form-check">
          <input v-model="showAge" class="form-check-input" type="checkbox" value="" id="show-age">
          <label class="form-check-label" for="show-age">
            Show Age
          </label>
        </div>
         
        <div class="mb-3">
          <label for="body-type" class="form-label">Body Type</label>
          <select v-model="bodyType" class="form-select" id="body-type">
            <option value="fat">Fat</option>
            <option value="normal">Normal</option>
            <option value="thin">Thin</option>
            <option value="chubby">Chubby</option>
            <option value="muscular">Muscular</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="gender" class="form-label">Gender</label>
          <select v-model="gender" class="form-select" id="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="non-binary">Non-Binary</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="sexuality" class="form-label">Sexuality</label>
          <select v-model="sexuality" class="form-select" id="sexuality">
            <option value="straight">Straight</option>
            <option value="gay">Gay</option>
            <option value="lesbian">Lesbian</option>
            <option value="bisexual">Bisexual</option>
            <option value="pansexual">Pansexual</option>
            <option value="asexual">Asexual</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="position" class="form-label">Position</label>
          <select v-model="position" class="form-select" id="position">
            <option value="top">Top</option>
            <option value="bottom">Bottom</option>
            <option value="verse-top">Verse Top</option>
            <option value="verse-bottom">Verse Bottom</option>
          </select>
        </div>
        <!-- Ethnicity -->
        <div class="mb-3">
            <label for="ethnicity" class="form-label">Ethnicity</label>
            <select v-model="ethnicity" class="form-select" id="ethnicity">
                <option value="Asian">Asian</option>
                <option value="Black">Black</option>
                <option value="Hispanic or Latino">Hispanic or Latino</option>
                <option value="Middle Eastern">Middle Eastern</option>
                <option value="Native American">Native American</option>
                <option value="Pacific Islander">Pacific Islander</option>
                <option value="White">White</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <!-- Relationship Status -->
        <div class="mb-3">
            <label for="relationship-status" class="form-label">Relationship Status</label>
            <select v-model="relationshipStatus" class="form-select" id="relationship-status">
                <option value="Single">Single</option>
                <option value="Taken">Taken</option>
                <option value="Married">Married</option>
                <option value="Open">Open</option>
                <option value="Poly">Poly</option>
            </select>
        </div>

        <!-- Accepts NSFW -->
        <div class="form-check">
            <input v-model="acceptsNSFW" class="form-check-input" type="checkbox" value="" id="accepts-nsfw">
            <label class="form-check-label" for="accepts-nsfw">
                Accepts NSFW
            </label>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>

        </form>
    </div>
</template>

<script lang="ts">
import API from '@/api';
import { useUserStore } from '@/stores/user';
import { defineComponent } from 'vue';
import { useRoute, useRouter } from 'vue-router';

export default defineComponent({
  name: 'ProfileEditor',
  data() {
    return {
      displayName: '',
      gender: '',
      sexuality: '',
      bio: '',
      showAge: false,
      bodyType: '',
      position: '',
      ethnicity: '',
      relationshipStatus: '',
      acceptsNSFW: false,
    };
  },
  methods: {
    submitForm() {
      const userStore = useUserStore();
      console.log(userStore.user);
      const profileData = {
        id: userStore.user?.id,
        displayName: this.displayName,
        gender: this.gender,
        sexuality: this.sexuality,
        bio: this.bio,
        showAge: this.showAge,
        bodyType: this.bodyType,
        position: this.position,
        ethnicity: this.ethnicity,
        relationshipStatus: this.relationshipStatus,
        acceptsNSFW: this.acceptsNSFW,
      };
      
      console.log(profileData);
      API.user.saveProfile(profileData, (data: any) => {
        console.log(data);
        this.$router.push('/home'); // Navigate to /home
      }, (err: any) => {
        console.log(err);
      })
    },
  },
});
</script>
