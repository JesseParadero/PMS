import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import dotenv from 'dotenv';
import fs from 'fs';

dotenv.config();

var viteConfig = {
    plugins: [
        laravel({
            input: ['resources/css/compile.css', 'resources/js/compile.js'],
            refresh: true
        })
    ],
    server: {
        // DAN (2023/08/24 20:39) - for self sign certificate (openssl req -newkey rsa:2048 -new -nodes -x509 -days 3650 -keyout key.pem -out cert.pem)
        // https: {
        //     key: fs.readFileSync('Work\\_virtual\\laradock\\nginx\\ssl\\custom-key.pem'),
        //     cert: fs.readFileSync('Work\\_virtual\\laradock\\nginx\\ssl\\custom-cert.pem')
        // },
        host: '0.0.0.0',
        port: process.env.VITE_SERVER_PORT
    }
};

if (process.env.VITE_LOCAL_IP) {
    viteConfig['server']['hmr'] = {
        host: process.env.VITE_LOCAL_IP,
        clientPort: process.env.VITE_SERVER_PORT
    };
}

export default defineConfig(viteConfig);