import React from 'react';
import { createRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';

// Si prefieres usar un solo CSS general
import './app.css';

createInertiaApp({
  // Desactiva el indicador de progreso (opcional) o instala @inertiajs/progress
  // resolve is how Inertia finds your Page components
  resolve: (name) => {
    // Vite glob import para cargar automáticamente los componentes de la carpeta "pages"
    const pages = import.meta.glob('./pages/**/*.jsx', { eager: true });
    return pages[`./pages/${name}.jsx`];
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />);
  },
});
