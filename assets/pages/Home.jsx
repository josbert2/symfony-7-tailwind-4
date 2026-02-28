import React from 'react';

export default function Home({ message }) {
    return (
        <div className="p-8 max-w-4xl mx-auto rounded-lg shadow-lg bg-white mt-10">
            <h1 className="text-3xl font-bold mb-4 text-blue-600">
                ¡React con Inertia Vite y Symfony 7 funciona!
            </h1>
            <p className="text-gray-700 text-lg">
                Mensaje desde el backend (PHP): <strong className="text-green-600">{message}</strong>
            </p>
        </div>
    );
}
