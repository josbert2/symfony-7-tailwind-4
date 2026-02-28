import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import tailwindcss from '@tailwindcss/vite';

/* if you're using React */
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react(), // enabled React
        symfonyPlugin(),
        tailwindcss()
    ],
    build: {
        rollupOptions: {
            input: {
                app: "./assets/app.jsx", // Inertia entry file
                proveedor: "./assets/proveedor/app.css",
                admin: "./assets/admin/app.css",
                theme: "./assets/app.css",
            },
        }
    },
});
