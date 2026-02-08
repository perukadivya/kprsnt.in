<script setup lang="ts">
import { ref, onMounted } from 'vue';

const resume = ref<any>(null);
const loading = ref(true);

onMounted(async () => {
  try {
    const res = await fetch('/api/resume');
    const data = await res.json();
    if (data.status === 'success') {
      resume.value = data.data;
    }
  } catch (e) {
    console.error('Failed to load resume', e);
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <div class="min-h-screen pt-24 px-4 container mx-auto max-w-3xl">
    <h2 class="text-4xl font-bold text-white mb-12 text-center">Experience & Education</h2>
    
    <div v-if="loading" class="text-center text-gray-400">Loading...</div>
    
    <div v-else>
      <div class="mb-12">
        <h3 class="text-2xl font-bold text-blue-400 mb-6 flex items-center">
          <span class="w-2 h-2 bg-blue-400 rounded-full mr-3"></span>
          Professional Experience
        </h3>
        
        <div class="space-y-8 border-l-2 border-gray-700 ml-1 pl-8">
          <div v-for="(job, index) in resume.experience" :key="index" class="relative">
            <span class="absolute -left-[37px] top-1 w-4 h-4 rounded-full bg-gray-900 border-2 border-blue-500"></span>
            
            <h4 class="text-xl font-bold text-white">{{ job.role }}</h4>
            <div class="flex justify-between items-center text-sm text-gray-400 mb-2">
              <span>{{ job.company }}</span>
              <span>{{ job.period }}</span>
            </div>
            <p class="text-gray-300">{{ job.description }}</p>
          </div>
        </div>
      </div>

      <div>
        <h3 class="text-2xl font-bold text-purple-400 mb-6 flex items-center">
          <span class="w-2 h-2 bg-purple-400 rounded-full mr-3"></span>
          Education
        </h3>
        
        <div class="space-y-8 border-l-2 border-gray-700 ml-1 pl-8">
          <div v-for="(edu, index) in resume.education" :key="index" class="relative">
            <span class="absolute -left-[37px] top-1 w-4 h-4 rounded-full bg-gray-900 border-2 border-purple-500"></span>
            
            <h4 class="text-xl font-bold text-white">{{ edu.degree }}</h4>
            <div class="flex justify-between items-center text-sm text-gray-400 mb-2">
              <span>{{ edu.school }}</span>
              <span>{{ edu.period }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
