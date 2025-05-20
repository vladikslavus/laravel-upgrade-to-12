import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import tailwindcss from '@tailwindcss/vite';
import fs from 'fs'; // Добавляем модуль fs для чтения файлов сертификатов
import path from 'path';

// Транспилирует код в ES5 через Babel.
// Генерирует два варианта файлов:
// Современный(ES6 +) — для новых браузеров.
// Легаси(ES5) — для старых.
// Добавляет nomodule - атрибут для легаси - скриптов.
// import legacy from '@vitejs/plugin-legacy'; // Уберём нахрен

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            // refresh: true, // По дефолту обновляет только фронт
            refresh: [
                'resources/views/**/*', // Blade шаблоны
                'app/**/*.php',         // Контроллеры, модели и т.д.
                'routes/**/*.php',      // Роуты
            ],
        }),
        // tailwindcss(),
    ],
    build: {
        target: 'es2015' // ← Явно говорим: "Никакого ES5!"
    },
    server: {
        https: {
            key: fs.readFileSync('./certs/lv-base.loc-key.pem'), // путь к приватному ключу
            cert: fs.readFileSync('./certs/lv-base.loc.pem'),     // путь к сертификату
        },
        host: 'lv-base.loc',
        port: 5173,
        hmr: {
            host: 'lv-base.loc',
            protocol: 'wss', // WebSocket Secure — подходит для HTTPS
        },
    },
    css: {
        devSourcemap: true, // Включает sourcemaps для CSS/SCSS в dev-режиме
        preprocessorOptions: {
            scss: {
                // additionalData: `@use "@/scss/variables" as *;`,
                // Включаем только поддержку SCSS без дополнительных импортов
                quietDeps: true, // Подавляет deprecated-предупреждения
                sassOptions: {
                    logger: {
                        warn: () => { } // Полностью отключает предупреждения
                    }
                }
            }
        }
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
            '~': path.resolve(__dirname, 'node_modules')
        }
    }
});

