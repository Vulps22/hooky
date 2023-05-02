<template>
  <div class="navigation-bar">
    <div class="profile">
     <!-- <img :src="profileImage" class="profile-picture">-->
      <div class="display-name">{{ user?.profile.display_name ?? '' }}</div>
    </div>
    <ul class="menu">
      <li class="menu-item"><a href="#">Home</a></li>
    </ul>
  </div>
</template>

<script lang="ts">
import { useUserStore } from '@/stores/user';
import { defineComponent } from 'vue';

export default defineComponent({
  setup() {
    const userStore = useUserStore();
    const user = userStore.user;
    const profileImage = user?.profile.images[0] ?? '/assets/blank.png';

    console.log(user);

    return {
      user,
      profileImage
    };
  },
});
</script>

<style scoped>
.navigation-bar {
  position: sticky;
  top: 0;
  background-color: black;
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  margin-right: 8rem;
  height: 100vh;
  z-index: 9999;
}

.profile {
  display: flex;
  align-items: center;
}

.profile-picture {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.display-name {
  font-weight: bold;
  margin-right: 10px;
}

.menu {
  margin-top: auto;
  display: flex;
  flex-direction: column;
  margin: 0;
  padding: 0;
  list-style: none;
}

.menu-item {
  margin: 0;
}

.menu-item a {
  color: white;
  text-decoration: none;
  font-size: 1.2rem;
}

.menu-item a:hover {
  text-decoration: underline;
}
</style>
