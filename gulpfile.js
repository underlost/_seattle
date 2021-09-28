/*!
 * Based on UnderTasker by Tyler Rilling
 * Copyright 2021 Tyler Rilling
 * Licensed under MIT (https://github.com/underlost/Undertasker/blob/master/LICENSE)
 */

// grab our packages
var gulp   = require('gulp'),
    jshint = require('gulp-jshint');
    sass = require('gulp-sass')(require('sass'));
    sourcemaps = require('gulp-sourcemaps');
    concat = require('gulp-concat');
    autoprefixer = require('gulp-autoprefixer');
    cleanCSS = require('gulp-clean-css');
    rename = require('gulp-rename'); // to rename any file
    uglify = require('gulp-uglify-es').default;
    del = require('del');
    stylish = require('jshint-stylish');
    imagemin = require('gulp-imagemin');


// Cleans the web dist folder
gulp.task('clean', function () {
  del(['dist/']);
});

// Copy fonts task
gulp.task('copy-fonts', function() {
  return gulp.src([
    'inc/fonts/**/*.{ttf,woff,eof,svg,eot,woff2,otf}',
    'node_modules/@fortawesome/fontawesome-free/webfonts/*.{ttf,woff,eof,svg,eot,woff2,otf}',
  ])
  .pipe(gulp.dest('dist/fonts'));
});
// Copy Components
gulp.task('copy-bootstrap', function() {
  return gulp.src('node_modules/bootstrap/scss/**/*.*')
  .pipe(gulp.dest('inc/sass/bootstrap'));
});
gulp.task('copy-font-awesome', function() {
  return gulp.src('node_modules/@fortawesome/fontawesome-free/scss/**/*.*')
  .pipe(gulp.dest('inc/sass/font-awesome'));
});

// Install task
gulp.task('install', gulp.parallel('copy-bootstrap', 'copy-font-awesome', 'copy-fonts'));

// Minify Images
gulp.task('imagemin', function() {
  return gulp.src('inc/img/**/*.{jpg,png,gif,ico}')
	.pipe(imagemin())
	.pipe(gulp.dest('dist/images'))
});

// CSS Build Task
gulp.task('build-css', function() {
  return gulp.src('inc/sass/site.scss')
  //.pipe(sourcemaps.init())  // Process the original sources
  .pipe(sass().on('error', sass.logError))
  //.pipe(sourcemaps.write()) // Add the map to modified source.
  .pipe(autoprefixer())
  .pipe(gulp.dest('dist/css'))
  .pipe(cleanCSS())
  .pipe(rename('site.min.css'))
  .pipe(gulp.dest('dist/css'))
  .on('error', sass.logError)
});

// Concat All JS into unminified single file
gulp.task('concat-js', function() {
  return gulp
    .src([
      //'node_modules/jquery/dist/jquery.js',
      //'inc/js/skip-link-focus-fix.js',
      "node_modules/vanilla-lazyload/dist/lazyload.min.js",
      "node_modules/bootstrap/dist/js/bootstrap.bundle.js",
      "node_modules/packery/dist/packery.pkgd.min.js",
      "node_modules/featherlight/release/featherlight.min.js",
      "inc/js/theme.js",
      //'inc/js/_isotope.js',
      //'inc/js/_packery.js',
    ])
    .pipe(sourcemaps.init())
    .pipe(concat("site.js"))
    .pipe(sourcemaps.write("./maps"))
    .pipe(gulp.dest("dist/js"));
});

// configure the jshint task
gulp.task('jshint', function() {
  return gulp.src('inc/js/*.js')
  .pipe(jshint())
  .pipe(jshint.reporter('jshint-stylish'));
});

// Shrinks all the js
gulp.task('shrink-js', function() {
  return gulp.src('dist/js/site.js')
  .pipe(uglify())
  .pipe(rename('site.min.js'))
  .pipe(gulp.dest('dist/js'))
});

// Default Javascript build task
gulp.task('build-js', gulp.series('concat-js', 'shrink-js'));

// configure which files to watch and what tasks to use on file changes
gulp.task('watch', function() {
  gulp.watch('inc/js/**/*.js', gulp.series('build-js'));
  gulp.watch('inc/sass/**/*.scss', gulp.series('build-css'));
  gulp.watch('inc/img/**/*.{jpg,png,gif,ico}', gulp.series('imagemin'));
});

// Default build task
gulp.task('build', gulp.parallel('build-css', 'build-js'));

// Default task
gulp.task('default', gulp.series('build', 'watch'));
