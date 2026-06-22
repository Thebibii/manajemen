import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ["alpinejs", "@popperjs/core"],
                    charts: ["apexcharts"],
                    calendar: ["@fullcalendar/core"],
                    flatpickr: ["flatpickr"],
                },
            },
        },
    },
});
