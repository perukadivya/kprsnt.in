<script setup lang="ts">
import AntigravityBackground from '../components/AntigravityBackground.vue';
</script>

<template>
  <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <AntigravityBackground />
    
    <div class="z-10 text-center px-4">
      <h1 class="text-6xl md:text-8xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 mb-6 animate-fade-in-up">
        DIVYA MOUNIKA
      </h1>
      <p class="text-xl md:text-2xl text-gray-300 mb-4 max-w-2xl mx-auto animate-fade-in-up delay-100">
        English & Math Teacher | Math Trainer
      </p>
      
      <div class="text-gray-400 mb-8 animate-fade-in-up delay-100 flex flex-col items-center gap-2">
        <p>📍 Hyderabad, India</p>
        <p>📞 +91 7013753349</p>
        <p>✉️ perukadivya0@gmail.com</p>
      </div>

      <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up delay-200">
        <router-link 
          to="/projects" 
          class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-medium transition-all transform hover:scale-105"
        >
          View Work
        </router-link>
        <a 
          href="mailto:perukadivya0@gmail.com"
          class="px-8 py-3 border border-gray-600 hover:border-white text-gray-300 hover:text-white rounded-full font-medium transition-all"
        >
          Contact Me
        </a>
      </div>
    </div>
  </div>
</template>

<style scoped>
.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
  opacity: 0;
  transform: translateY(20px);
}

.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }

@keyframes fadeInUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
