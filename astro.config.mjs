import { defineConfig } from 'astro/config';
import node from '@astrojs/node';

import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  output: 'server',
  adapter: node({
    mode: 'standalone'
  }),
  site: 'https://example.com',
  server: {
    port: 4321,
    host: true
  },
  vite: {
    server: {
      allowedHosts: ['localhost', '.ngrok-free.app', '.ngrok.io']
    },

    plugins: [tailwindcss()]
  }
});