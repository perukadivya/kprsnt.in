<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

const canvasRef = ref<HTMLCanvasElement | null>(null);

// Google Colors
const COLORS = ['#4285F4', '#EA4335', '#FBBC05', '#34A853'];

class Particle {
  x: number;
  y: number;
  vx: number;
  vy: number;
  size: number;
  color: string;
  width: number;
  height: number;

  constructor(canvasWidth: number, canvasHeight: number) {
    this.x = Math.random() * canvasWidth;
    this.y = Math.random() * canvasHeight;
    this.vx = (Math.random() - 0.5) * 1.5;
    this.vy = (Math.random() - 0.5) * 1.5;
    this.size = Math.random() * 3 + 2;
    this.color = COLORS[Math.floor(Math.random() * COLORS.length)];
    this.width = this.size;
    this.height = this.size * 2.5; // Pill shape aspect ratio
  }

  update(canvasWidth: number, canvasHeight: number, mouse: { x: number, y: number, active: boolean }) {
    // Basic Movement
    this.x += this.vx;
    this.y += this.vy;

    // Bounce off edges
    if (this.x < 0 || this.x > canvasWidth) this.vx *= -1;
    if (this.y < 0 || this.y > canvasHeight) this.vy *= -1;

    // Antigravity (Mouse Repel)
    if (mouse.active) {
      const dx = this.x - mouse.x;
      const dy = this.y - mouse.y;
      const distance = Math.sqrt(dx * dx + dy * dy);
      const forceRadius = 150;

      if (distance < forceRadius) {
        const force = (forceRadius - distance) / forceRadius;
        const angle = Math.atan2(dy, dx);
        const pushX = Math.cos(angle) * force * 5;
        const pushY = Math.sin(angle) * force * 5;
        
        this.vx += pushX * 0.1;
        this.vy += pushY * 0.1;
      }
    }

    // Friction to stabilize speed
    this.vx *= 0.99;
    this.vy *= 0.99;
  }

  draw(ctx: CanvasRenderingContext2D) {
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.roundRect(this.x, this.y, this.width, this.height, 2);
    ctx.fill();
  }

  explode(x: number, y: number) {
      const dx = this.x - x;
      const dy = this.y - y;
      const distance = Math.sqrt(dx * dx + dy * dy);
      
      // Stronger push for close particles
      if (distance < 250) {
          const force = (250 - distance) / 250;
          const angle = Math.atan2(dy, dx);
          this.vx += Math.cos(angle) * force * 30; // Explosion force
          this.vy += Math.sin(angle) * force * 30;
      }
  }
}

onMounted(() => {
  const canvas = canvasRef.value!;
  const ctx = canvas.getContext('2d')!;
  
  let animationId: number;
  let particles: Particle[] = [];
  
  const mouse = { x: 0, y: 0, active: false };

  const resize = () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    initParticles();
  };

  const initParticles = () => {
    particles = [];
    const particleCount = calculateParticleCount();
    for (let i = 0; i < particleCount; i++) {
      particles.push(new Particle(canvas.width, canvas.height));
    }
  };

  const calculateParticleCount = () => {
    // Responsive count: fewer on mobile
    return window.innerWidth < 768 ? 60 : 150;
  };

  const animate = () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    particles.forEach(p => {
      p.update(canvas.width, canvas.height, mouse);
      p.draw(ctx);
    });

    animationId = requestAnimationFrame(animate);
  };

  // Event Listeners
  window.addEventListener('resize', resize);
  
  window.addEventListener('mousemove', (e) => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
    mouse.active = true;
    
    // Deactivate "active" push after a short delay to stop constant pushing if stopped
    clearTimeout((window as any).mouseTimeout);
    (window as any).mouseTimeout = setTimeout(() => { mouse.active = false; }, 100);
  });

  window.addEventListener('click', (e) => {
      particles.forEach(p => p.explode(e.clientX, e.clientY));
  });

  // Init
  resize();
  animate();

  onUnmounted(() => {
    cancelAnimationFrame(animationId);
    window.removeEventListener('resize', resize);
  });
});
</script>

<template>
  <canvas 
    ref="canvasRef" 
    class="fixed inset-0 w-full h-full pointer-events-none z-[-1]"
  ></canvas>
</template>

<style scoped>
/* Ensure canvas is behind everything */
canvas {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 0; /* Behind content but visible */
}
</style>
