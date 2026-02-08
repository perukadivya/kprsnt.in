<script setup lang="ts">
import { ref, onMounted } from 'vue';

const posts = ref<any[]>([]);
const loading = ref(true);

onMounted(async () => {
  try {
    const res = await fetch('/api/blog');
    const data = await res.json();
    if (data.status === 'success') {
      posts.value = data.data;
    }
  } catch (e) {
    console.error('Failed to load blog posts', e);
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <div class="min-h-screen pt-24 px-4 container mx-auto max-w-4xl">
    <h2 class="text-4xl font-bold text-white mb-12 text-center">Latest Insights</h2>
    
    <div v-if="loading" class="text-center text-gray-400">Loading articles...</div>
    
    <div v-else class="space-y-6">
      <article 
        v-for="post in posts" 
        :key="post.id"
        class="bg-gray-800/40 backdrop-blur border border-gray-700 rounded-xl p-8 hover:bg-gray-800/60 transition-colors"
      >
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
          <h3 class="text-2xl font-bold text-white group-hover:text-blue-400 transition-colors">
            {{ post.title }}
          </h3>
          <span class="text-sm text-gray-500 whitespace-nowrap">{{ post.date }} • {{ post.readTime }}</span>
        </div>
        
        <p class="text-gray-300 mb-6 leading-relaxed">
          {{ post.excerpt }}
        </p>
        
        <a href="#" class="text-blue-400 hover:text-blue-300 font-medium inline-flex items-center">
          Read Article <span class="ml-2">→</span>
        </a>
      </article>
    </div>
  </div>
</template>
