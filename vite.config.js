import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import basicSsl from "@vitejs/plugin-basic-ssl";
import Components from "unplugin-vue-components/vite";

export default defineConfig({
    server: { https: true },
    plugins: [
        basicSsl(),
        laravel(["resources/js/app.js", "resources/css/app.css"]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        Components({
            /* options */
        }),
    ],
});
