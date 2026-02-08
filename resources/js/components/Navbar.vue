<script setup lang="ts">
import { ref } from 'vue';

const isOpen = ref(false);

const links = [
  { name: 'Home', path: '/' },
  { name: 'Projects', path: '/projects' },
  { name: 'Skills', path: '/skills' },
  { name: 'Resume', path: '/resume' },
  { name: 'Blog', path: '/blog' },
];
</script>

<template>
  <nav class="fixed top-0 w-full z-50 bg-gray-900/80 backdrop-blur-md border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <router-link to="/" class="text-xl font-bold text-white">
            Divya<span class="text-blue-500">.Portfolio</span>
          </router-link>
        </div>
        
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <router-link 
              v-for="link in links" 
              :key="link.name" 
              :to="link.path"
              class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 transition"
              active-class="bg-gray-800 text-white"
            >
              {{ link.name }}
            </router-link>
          </div>
        </div>
        
        <div class="-mr-2 flex md:hidden">
          <button @click="isOpen = !isOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none">
            <span class="sr-only">Open main menu</span>
            <svg class="h-6 w-6" :class="{'hidden': isOpen, 'block': !isOpen }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg class="h-6 w-6" :class="{'block': isOpen, 'hidden': !isOpen }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden" :class="{'block': isOpen, 'hidden': !isOpen }">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-900 border-b border-gray-800">
        <router-link 
          v-for="link in links" 
          :key="link.name" 
          :to="link.path"
          class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700"
          active-class="bg-gray-800 text-white"
          @click="isOpen = false"
        >
          {{ link.name }}
        </router-link>
      </div>
    </div>
  </nav>
</template>
