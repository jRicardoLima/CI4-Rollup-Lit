import fs from "node:fs";
import path from "node:path";

const assetsDir = path.resolve("public/assets");
const manifestPath = path.join(assetsDir, "manifest.json");

if (!fs.existsSync(manifestPath)) {
    console.error("[patch-manifest] manifest.json not found:", manifestPath);
    process.exit(1);
}

const manifest = JSON.parse(fs.readFileSync(manifestPath, "utf8"));

const files = fs.readdirSync(assetsDir);
const cssFile = files.find((f) => /^app-[\w.-]+\.css$/.test(f)) || files.find((f) => f.endsWith(".css"));

if (!cssFile) {
    console.warn("[patch-maniefest] no CSS file found in", assetsDir);
    process.exit(0);
}

manifest["app.css"] = `/assets/${cssFile}`;

fs.writeFileSync(manifestPath, JSON.stringify(manifest, null, 2) + "\n", "utf8");

console.log("[patch-manifest] added app.css:", manifest["app.css"]);