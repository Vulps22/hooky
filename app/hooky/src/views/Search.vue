<template>
    <div class="search">
        <ImageGrid :profiles="[
  { id: 1, name: 'Emma', age: 28, distance: '5.1 miles', image: 'http://localhost/assets/woman1.jpg' },
  { id: 2, name: 'Jack', age: 32, distance: '12.4 miles', image: 'http://localhost/assets/man1.jpg' },
  { id: 3, name: 'Sophie', age: 25, distance: '3.2 miles', image: 'http://localhost/assets/woman2.jpg' },
  { id: 4, name: 'Olivia', age: 29, distance: '7.9 miles', image: 'http://localhost/assets/woman1.jpg' },
  { id: 5, name: 'Harry', age: 30, distance: '11.7 miles', image: 'http://localhost/assets/man1.jpg' },
  { id: 6, name: 'James', age: 27, distance: '8.3 miles', image: 'http://localhost/assets/man2.jpg' },
  { id: 7, name: 'Emily', age: 26, distance: '6.5 miles', image: 'http://localhost/assets/woman1.jpg' },
  { id: 8, name: 'George', age: 28, distance: '10.2 miles', image: 'http://localhost/assets/man2.jpg' },
  { id: 9, name: 'Mia', age: 24, distance: '2.9 miles', image: 'http://localhost/assets/woman2.jpg' },
  { id: 10, name: 'William', age: 31, distance: '9.6 miles', image: 'http://localhost/assets/man1.jpg' },
  { id: 11, name: 'Henry', age: 29, distance: '13.5 miles', image: 'http://localhost/assets/man2.jpg' },
  { id: 12, name: 'Charlotte', age: 23, distance: '4.8 miles', image: 'http://localhost/assets/man1.jpg' },
  { id: 13, name: 'Isabella', age: 27, distance: '5.6 miles', image: 'http://localhost/assets/woman2.jpg' },
  { id: 14, name: 'Ava', age: 25, distance: '2.7 miles', image: 'http://localhost/assets/woman2.jpg' },
  { id: 15, name: 'Noah', age: 28, distance: '8.1 miles', image: 'http://localhost/assets/woman1.jpg' }
]
" :key="new Date().getTime()" />

    </div>
  </template>
  
  <script lang="ts">
  import ImageGrid from '@/components/ImageGrid.vue'
  
  export default {
    components: {
      ImageGrid
    }
  }
  </script>
  