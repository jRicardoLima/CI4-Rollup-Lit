import typescript from '@rollup/plugin-typescript';
import { nodeResolve } from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import terser from '@rollup/plugin-terser';
import { defineConfig } from 'rollup';
import manifestImport from 'rollup-plugin-output-manifest';

const outputManifest = manifestImport?.outputManifest ?? manifestImport?.default ?? manifestImport;

export default defineConfig({
    input: {
        app: "writable/resources/frontend/app.ts"
    },
    output: {
        dir: "public/assets",
        format: "es",
        entryFileNames: "[name]-[hash].js",
        chunkFileNames: "chunks/[name]-[hash].js",
        assetFileNames: "[name]-[hash][extname]",
        banner: ""
    },
    plugins: [
        nodeResolve({
            browser: true,
            extensions: [".mjs", ".js", ".json", ".ts"]
        }),
        commonjs(),
        typescript({ tsconfig: "./tsconfig.json" }),
        terser({
            format: { comments: false },
            compress: { passes: 2 },
            mangle: { module: true, toplevel: true }
        }),
        outputManifest({
            fileName: "manifest.json",
            publicPath: "/assets/"
        })
    ]
});