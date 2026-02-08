<script setup lang="ts">
import AntigravityBackground from './components/AntigravityBackground.vue';
import Navbar from './components/Navbar.vue';
</script>

<template>
  <AntigravityBackground />
  <Navbar />
  
  <main class="relative z-10">
    <router-view v-slot="{ Component }">
      <transition name="fade" mode="out-in">
        <component :is="Component" />
      </transition>
    </router-view>
  </main>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
