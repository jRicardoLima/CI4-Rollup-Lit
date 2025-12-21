import typescript from '@rollup/plugin-typescript';
import { nodeResolve } from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import terser from '@rollup/plugin-terser';
import { defineConfig } from 'rollup';
import manifestImport from 'rollup-plugin-output-manifest';
import postcss from 'rollup-plugin-postcss';
import { spawn } from 'node:child_process';

const outputManifest = manifestImport?.outputManifest ?? manifestImport?.default ?? manifestImport;

function patchManifestPlugin() {
    return {
        name: 'ci-patch-manifest',
        async writeBundle() {
            return new Promise((resolve, reject) => {
                const child = spawn(
                    'node',
                    ['writable/resources/frontend/scripts/patch-manifest.mjs'],
                    { stdio: 'inherit' }
                );

                child.on('exit', (code) => (code === 0 ? resolve() : reject(new Error(`patch-manifest exit code ${code}`))))
            });
        }
    }
}

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
        postcss({
            extract: true,
            minimize: true,
        }),
        typescript({ tsconfig: "./tsconfig.json" }),
        terser({
            format: { comments: false },
            compress: { passes: 2 },
            mangle: { module: true, toplevel: true }
        }),
        outputManifest({
            fileName: "manifest.json",
            publicPath: "/assets/"
        }),
        patchManifestPlugin(),
    ]
});