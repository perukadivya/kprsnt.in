<script setup lang="ts">
import { ref, onMounted } from 'vue';

interface Project {
  id: number;
  title: string;
  description: string;
  technologies: string[];
  image: string;
  link: string;
}

const projects = ref<Project[]>([]);
const loading = ref(true);

onMounted(async () => {
  try {
    const res = await fetch('/api/projects');
    const data = await res.json();
    if (data.status === 'success') {
      projects.value = data.data;
    }
  } catch (e) {
    console.error('Failed to load projects', e);
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <div class="min-h-screen pt-24 px-4 container mx-auto">
    <h2 class="text-4xl font-bold text-white mb-12 text-center">My Projects</h2>
    
    <div v-if="loading" class="text-center text-gray-400">Loading projects...</div>
    
    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div 
        v-for="project in projects" 
        :key="project.id"
        class="bg-gray-800/50 backdrop-blur-md border border-gray-700 rounded-xl overflow-hidden hover:transform hover:scale-105 transition-all duration-300 group"
      >
        <div class="h-48 bg-gray-700 relative overflow-hidden">
          <img :src="project.image" :alt="project.title" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
        </div>
        
        <div class="p-6">
          <h3 class="text-xl font-bold text-white mb-2">{{ project.title }}</h3>
          <p class="text-gray-400 mb-4 text-sm">{{ project.description }}</p>
          
          <div class="flex flex-wrap gap-2 mb-6">
            <span 
              v-for="tech in project.technologies" 
              :key="tech"
              class="px-2 py-1 text-xs bg-blue-900/50 text-blue-300 rounded"
            >
              {{ tech }}
            </span>
          </div>
          
          <a :href="project.link" class="text-blue-400 hover:text-blue-300 text-sm font-medium flex items-center">
            View Project <span class="ml-1">→</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
