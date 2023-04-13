<template>
    <div class="image-grid">
      <div class="image-grid__item" v-for="(profile, index) in profiles" :key="profile.id">
        <div class="image-grid__image-wrapper">
          <img :src="profile.image" class="image-grid__image" @error="useFallbackImage">
          <div class="image-grid__item-text">
            <div class="image-grid__item-text__name"><strong>{{ profile.name }}</strong> | {{ profile.age }}</div>
            <div class="image-grid__item-text__distance">{{ profile.distance }}</div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script lang="ts">
  export default {
    props: {
      profiles: {
        type: Array,
        required: true,
        default: () => [],
      },
    },
    methods: {
      useFallbackImage(event) {
        event.target.parentNode.style.backgroundColor = '#eee'; // set fallback background color
      },
    },
  };
  </script>
  
  <style scoped>
  .image-grid {
    display: flex;
    flex-wrap: wrap;
  }
  
  .image-grid__item {
    width: 23%;
    height: 33%;
    margin: 10px;
    position: relative;
  }
  
  .image-grid__item img {
    max-width: 100%;
    max-height: 100%;
  }
  
  .image-grid__image-wrapper {
    position: relative;
  }
  
  .image-grid__item-text {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 20%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.1) 100%);
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: 5px;
    box-sizing: border-box;
  }
  
  .image-grid__item-text__name strong {
    font-weight: bold;
  }
  </style>
  