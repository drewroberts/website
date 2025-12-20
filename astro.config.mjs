import { defineConfig } from 'astro/config';
import mdx from '@astrojs/mdx';
import tailwind from '@tailwindcss/vite';

export default defineConfig({
  // 1. Set to static for GitHub Pages
  output: 'static',
  
  // 2. Your custom domain (important for sitemaps/canonical URLs)
  site: 'https://your-custom-domain.com',

  integrations: [
    mdx({
      // MDX configuration goes here
      optimize: true,
    })
  ],

  vite: {
    plugins: [tailwind()],
  },

  image: {
    // Article III of your Constitution: Mandate AVIF/WebP
    service: {
      entrypoint: 'astro/assets/services/sharp',
    },
    domains: [], // Add remote domains if you fetch images from your Laravel API
  },

  markdown: {
    // Professional typography defaults
    shikiConfig: {
      theme: 'dracula', // High-quality code highlighting for your Markdown
      wrap: true,
    },
  },
});