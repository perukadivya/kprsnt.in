import { createRouter, createWebHistory } from 'vue-router';
import Home from './views/Home.vue';
import Projects from './views/Projects.vue';
import Skills from './views/Skills.vue';
import Resume from './views/Resume.vue';
import Blog from './views/Blog.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/projects', component: Projects },
    { path: '/skills', component: Skills },
    { path: '/resume', component: Resume },
    { path: '/blog', component: Blog },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
