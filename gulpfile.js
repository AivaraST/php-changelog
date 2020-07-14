'use strict';

// Gulp modules
const gulp = require('gulp');
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const uglify = require('gulp-uglify-es').default;
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();

// Gulp settings.
const settings = {
    paths: {
        src: './src/',
        dist: './assets/',
        browserUrl: 'localhost/php-changelog',
    },
    watchOptions: {
        html: false,
        php: true,
        scss: true,
        js: true,
    },
};

// Gulp tasks
const compileSass = function () {
    return gulp.src(settings.paths.src + 'scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(rename('styles.css'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(settings.paths.dist + 'css'))
        .pipe(browserSync.stream());
}

const compileJs = function () {
    return gulp.src(settings.paths.src + 'js/**/*.js')
        .pipe(sourcemaps.init())
        .pipe(concat('bundle.js'))
        // .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(settings.paths.dist + 'js'))
}

const browserUpdater = function() {
    browserSync.init({
        proxy: settings.paths.browserUrl,
    });
}

const watchFiles = function(done) {
    if(settings.watchOptions.html) {
        gulp.watch('./**/*.html').on('change', browserSync.reload);
    }

    if(settings.watchOptions.php) {
        gulp.watch('./**/*.php').on('change', browserSync.reload);
    }

    if(settings.watchOptions.scss) {
        gulp.watch(settings.paths.src + 'scss/**/*.scss', compileSass);
        gulp.watch(settings.paths.dist + 'css/**/*.css').on('change', browserSync.reload);
    }

    if(settings.watchOptions.js) {
        gulp.watch(settings.paths.src + 'js/**/*.js', compileJs);
        gulp.watch(settings.paths.dist + 'js/**/*.js').on('change', browserSync.reload);
    }
}

exports.build = gulp.parallel(compileSass, compileJs);
exports.dev = gulp.parallel(compileSass, compileJs, browserUpdater, watchFiles);
