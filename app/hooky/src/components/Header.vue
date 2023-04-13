<template>
  <div class="header">
    <h3 class="logo">
      <img src="@/assets/logo.png" class="logo__img" alt="Hooky Logo" />
      <span class="logo__text">Hooky</span>
    </h3>
  </div>
</template>

<style scoped>
.header {
  background-color: black;
  height: 20%;
  max-height: 3rem;
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0px;
  width: 100vw;
  left: 0px;
  z-index: 9999; /* higher than the rest of the page */
}

.logo {
  display: flex;
  align-items: center;
  height: 100%;
}

.logo__img {
  width: auto;
  height: 100%;
  margin-right: 0.5rem;
}

.logo__text {
  font-size: 1.5rem;
  font-weight: bold;
  color: white;
}
</style>
