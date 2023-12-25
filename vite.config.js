import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

import copy from "rollup-plugin-copy-merge";

const targets = [
    // JS
    {
        src: [
            "resources/js/script.js",
            "resources/js/extras.js",
            "resources/js/components/*.js",
        ],
        file: "public/build/js/script.js",
    },
    // Vendor JS
    {
        src: [
            // Tippy.js
            "node_modules/@popperjs/core/dist/umd/popper.min.js",
            "node_modules/tippy.js/dist/tippy.umd.min.js",
        ],
        file: "public/build/js/vendor.js",
    },
    // Vendor Extras
    {
        src: [
            // Chart.js
            "node_modules/chart.js/dist/chart.min.js",
            // Sortable.js
            "node_modules/sortablejs/Sortable.min.js",
            // Glide.js
            "node_modules/@glidejs/glide/dist/glide.min.js",
            // CKEditor
            "node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js",
        ],
        dest: "public/build/js",
    },
];

const devOnly = {
    src: [
        // CKEditor
        "node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js.map",
        // Tippy.js
        "node_modules/tippy.js/dist/tippy.umd.min.js.map",
    ],
    dest: "public/build/js",
};

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/style.css", "resources/js/app.js"],
            refresh: true,
        }),
        copy({
            targets: [...targets, devOnly],
            hook: "buildStart",
            copyOnce: true,
        }),
        copy({
            targets: targets,
            hook: "writeBundle",
        }),
    ],
});
