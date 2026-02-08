<script setup lang="ts">
import { ref, onMounted } from 'vue';

const skills = ref<Record<string, string[]>>({});
const loading = ref(true);

onMounted(async () => {
  try {
    const res = await fetch('/api/skills');
    const data = await res.json();
    if (data.status === 'success') {
      skills.value = data.data;
    }
  } catch (e) {
    console.error('Failed to load skills', e);
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <div class="min-h-screen pt-24 px-4 container mx-auto">
    <h2 class="text-4xl font-bold text-white mb-12 text-center">Technical Skills</h2>
    
    <div v-if="loading" class="text-center text-gray-400">Loading skills...</div>
    
    <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
      <div 
        v-for="(items, category) in skills" 
        :key="category"
        class="bg-gray-800/30 backdrop-blur-sm border border-gray-700/50 rounded-2xl p-6"
      >
        <h3 class="text-xl font-semibold text-blue-400 mb-4">{{ category }}</h3>
        <div class="flex flex-wrap gap-3">
          <span 
            v-for="skill in items" 
            :key="skill"
            class="px-4 py-2 bg-gray-700/50 hover:bg-gray-700 text-gray-200 rounded-lg transition-colors cursor-default"
          >
            {{ skill }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
