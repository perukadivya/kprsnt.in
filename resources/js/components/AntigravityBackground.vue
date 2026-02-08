<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

const canvasRef = ref<HTMLCanvasElement | null>(null);

// Configuration
const PARTICLE_COLOR = 'rgba(255, 255, 255, 0.5)';
const LINE_COLOR = 'rgba(255, 255, 255, 0.15)';
const PARTICLE_SIZE = 2;
const CONNECTION_DISTANCE = 120;
const MOUSE_DISTANCE = 150;

class Particle {
  x: number;
  y: number;
  vx: number;
  vy: number;
  size: number;

  constructor(canvasWidth: number, canvasHeight: number) {
    this.x = Math.random() * canvasWidth;
    this.y = Math.random() * canvasHeight;
    this.vx = (Math.random() - 0.5) * 0.5; // Slow drift
    this.vy = (Math.random() - 0.5) * 0.5;
    this.size = Math.random() * 2 + 1;
  }

  update(canvasWidth: number, canvasHeight: number) {
    this.x += this.vx;
    this.y += this.vy;

    // Bounce off edges
    if (this.x < 0 || this.x > canvasWidth) this.vx *= -1;
    if (this.y < 0 || this.y > canvasHeight) this.vy *= -1;
  }

  draw(ctx: CanvasRenderingContext2D) {
    ctx.fillStyle = PARTICLE_COLOR;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
    ctx.fill();
  }
}

onMounted(() => {
  const canvas = canvasRef.value!;
  const ctx = canvas.getContext('2d')!;
  
  let animationId: number;
  let particles: Particle[] = [];
  
  const mouse = { x: 0, y: 0 };

  const resize = () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    initParticles();
  };

  const initParticles = () => {
    particles = [];
    const particleCount = Math.floor(window.innerWidth * window.innerHeight / 15000); // Density based on area
    for (let i = 0; i < particleCount; i++) {
      particles.push(new Particle(canvas.width, canvas.height));
    }
  };

  const animate = () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Update and draw particles
    particles.forEach(p => {
      p.update(canvas.width, canvas.height);
      p.draw(ctx);
    });

    // Draw connections
    connectParticles();

    animationId = requestAnimationFrame(animate);
  };

  const connectParticles = () => {
    for (let a = 0; a < particles.length; a++) {
      let opacityValue = 1;
      // Connect to mouse
        const dxMouse = particles[a].x - mouse.x;
        const dyMouse = particles[a].y - mouse.y;
        const distMouse = Math.sqrt(dxMouse * dxMouse + dyMouse * dyMouse);

        if (distMouse < MOUSE_DISTANCE) {
            const opacity = 1 - (distMouse / MOUSE_DISTANCE);
            ctx.strokeStyle = `rgba(100, 200, 255, ${opacity * 0.8})`; // Brighter Blue
            ctx.lineWidth = 2; // Thicker line
            ctx.beginPath();
            ctx.moveTo(particles[a].x, particles[a].y);
            ctx.lineTo(mouse.x, mouse.y);
            ctx.stroke();

            // Highlight particle
            ctx.beginPath();
            ctx.fillStyle = `rgba(100, 200, 255, ${opacity})`;
            ctx.arc(particles[a].x, particles[a].y, particles[a].size * 1.5, 0, Math.PI * 2);
            ctx.fill();
        }

      for (let b = a; b < particles.length; b++) {
        const dx = particles[a].x - particles[b].x;
        const dy = particles[a].y - particles[b].y;
        const distance = Math.sqrt(dx * dx + dy * dy);

        if (distance < CONNECTION_DISTANCE) {
          const opacity = 1 - (distance / CONNECTION_DISTANCE);
          ctx.strokeStyle = `rgba(255, 255, 255, ${opacity * 0.15})`; // Subtle lines
          ctx.lineWidth = 1;
          ctx.beginPath();
          ctx.moveTo(particles[a].x, particles[a].y);
          ctx.lineTo(particles[b].x, particles[b].y);
          ctx.stroke();
        }
      }
    }
  };

  // Event Listeners
  window.addEventListener('resize', resize);
  
  window.addEventListener('mousemove', (e) => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
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
canvas {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 0;
  background: transparent; /* Changed to transparent to overlay on the dark gradient body */
}
</style>
