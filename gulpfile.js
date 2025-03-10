const { src, dest, watch, parallel } = require("gulp");

// CSS
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");

// Images
const cache = require("gulp-cache");
const imagemin = require("gulp-imagemin");
const webp = require("gulp-webp");
const avif = require("gulp-avif");

// JavaScript
const terser = require("gulp-terser-js");
const concat = require("gulp-concat");
const rename = require("gulp-rename");

// WebPack
const webpack = require("webpack-stream");

const paths = {
    scss: "src/scss/**/*.scss",
    js: "src/js/**/*.js",
    imgs: "src/img/**/*",
};

function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: "expanded" }))
        .pipe(sourcemaps.write("."))
        .pipe(dest("public/build/css"));
}

function javascript() {
    return src(paths.js)
        .pipe(
            webpack({
                // Permitimos que webpack entienda que queremos compilar un css
                module: {
                    rules: [
                        {
                            // Busca archivos de css
                            test: /\.css$/i, // identifica archivo css
                            use: ["style-loader", "css-loader"],
                        },
                    ],
                },
                mode: "production",
                watch: true,
                // Entrada, archivo de donde webpack va a leer el contenido para crear el bundle con los componentes extraidos de lo que descarguemos de internet
                entry: "./src/js/app.js",
            })
        )
        .pipe(sourcemaps.init())
        .pipe(terser())
        .pipe(sourcemaps.write("."))
        .pipe(rename({ suffix: ".min" }))
        .pipe(dest("./public/build/js"));
}

function imgs() {
    return src(paths.imgs)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest("public/build/img"));
}

const options = {
    quality: 60,
};

function webpVersion(done) {
    src("src/img/**/*.{png,jpg}")
        .pipe(webp(options))
        .pipe(dest("public/build/img"));
    done();
}

function avifVersion(done) {
    src("src/img/**/*.{png,jpg}")
        .pipe(avif(options))
        .pipe(dest("public/build/img"));
    done();
}

function dev(done) {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch(paths.imgs, webpVersion);
    watch(paths.imgs, avifVersion);
    done();
}
exports.css;
exports.javascript;
exports.imgs;
exports.webpVersion;
exports.avifVersion;
exports.dev = parallel(css, imgs, webpVersion, avifVersion, javascript, dev);
