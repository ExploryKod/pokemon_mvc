import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';
import path from 'path';

// Define the port for Vite's development server
const port = process.env.VITE_PORT || 5173;

// Check for DDEV primary URL or fall back to localhost
const origin = process.env.VITE_DDEV_PRIMARY_URL
    ? `${process.env.VITE_DDEV_PRIMARY_URL}:${port}`
    : `http://localhost:${port}`;

export default defineConfig({
  plugins: [
    liveReload([
      // Define paths for live reload based on project structure
      path.join(__dirname, '/(app|config|views)/**/*.php'),
      path.join(__dirname, '/*.php'),
    ]),
  ],

  root: 'src',
  base: process.env.VITE_APP_ENV === 'development' ? '/' : '/dist/',

  build: {
    outDir: path.resolve(__dirname, 'dist'),
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: path.resolve(__dirname, 'src/assets/main.js'),
      output: {
        manualChunks(id) {
          if (id.includes('node_modules')) {
            return 'vendor';
          }
        },
      },
    },
  },

  server: {
    host: '0.0.0.0', 
    port: port,
    strictPort: true,
    origin: origin, 
  },
});
