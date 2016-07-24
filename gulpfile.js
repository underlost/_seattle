// Copyright 2016 Tyler Rilling
// grab our packages
var gulp   = require('gulp'),
    jshint = require('gulp-jshint');
    sass = require('gulp-sass');
    sourcemaps = require('gulp-sourcemaps');
    concat = require('gulp-concat');
    autoprefixer = require('gulp-autoprefixer');
    minifyCSS = require('gulp-minify-css');
    rename = require('gulp-rename'); // to rename any file
    uglify = require('gulp-uglify');
    del = require('del');
    stylish = require('jshint-stylish');
    runSequence = require('run-sequence');
    coffee = require('gulp-coffee');
    gutil = require('gulp-util');
    bower = require('gulp-bower');

// Cleans the web dist folder
gulp.task('clean', function (cb) {
    del(['dist/**/*',], cb);
});

// Copy fonts task
gulp.task('copy-fonts', function() {
    gulp.src('fonts/**/*.{ttf,woff,eof,svg,eot,woff2,otf}')
    .pipe(gulp.dest('dist/fonts'));
    // Copy Font scss
    gulp.src('bower_components/components-font-awesome/scss/**/*.scss')
    .pipe(gulp.dest('inc/sass/font-awesome'));
    // Copy Font files
    gulp.src('bower_components/components-font-awesome/fonts/**/*.{ttf,woff,eof,svg,eot,woff2,otf}')
    .pipe(gulp.dest('dist/fonts'));

    gulp.src('bower_components/bootstrap-sass/assets/fonts/bootstrap/**/*.{ttf,woff,eof,svg,eot,woff2,otf}')
    .pipe(gulp.dest('dist/fonts'));
});

// Copy images
gulp.task('copy-img', function() {
    gulp.src('img/**/*.{jpg,png,gif}')
    .pipe(gulp.dest('dist/img'));
});

// Copy Bower components
gulp.task('copy-bower', function() {
    gulp.src([
        'bower_components/bootstrap/dist/js/bootstrap.js',
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/packery/dist/packery.pkgd.js',
        'bower_components/mixitup/build/jquery.mixitup.min.js'
    ])
    .pipe(gulp.dest('dist/js/lib'));
});

// Compile coffeescript to JS
gulp.task('brew-coffee', function() {
    gulp.src('inc/coffee/*.coffee')
        .pipe(coffee({bare: true}).on('error', gutil.log))
        .pipe(gulp.dest('inc/js/coffee/'))
});

// CSS Build Task
gulp.task('build-css', function() {
  return gulp.src('inc/sass/site.scss')
    .pipe(sourcemaps.init())  // Process the original sources
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write()) // Add the map to modified source.
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(gulp.dest('dist/css'))
    .pipe(minifyCSS())
    .pipe(rename('seattle.min.css'))
    .pipe(gulp.dest('dist/css'))
    .on('error', sass.logError)
});

// Concat All JS into unminified single file
gulp.task('concat-js', function() {
    return gulp.src([
        // Bower components
        'bower_components/bootstrap/dist/js/bootstrap.js',
        'bower_components/imagesloaded/imagesloaded.pkgd.js',
        'bower_components/packery/dist/packery.pkgd.js',
        'bower_components/mixitup/build/jquery.mixitup.min.js',

        // Coffeescript
        'inc/js/coffee/*.js',

        'inc/js/wow.min.js',
        'inc/js/jquery.fancybox.pack.js',
        'inc/js/jquery.fitvids.js',
        //'inc/js/idangerous.swiper.min.js',
        'inc/js/skip-link-focus-fix.js',
        'inc/js/navigation.js',
        'inc/js/site.js',
        //'inc/js/retina.min.js'

    ])
    .pipe(sourcemaps.init())
        .pipe(concat('seattle.js'))
        .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('dist/js'));
});

// configure the jshint task
gulp.task('jshint', function() {
    return gulp.src('inc/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'));
});

// Shrinks all the js
gulp.task('shrink-js', function() {
    return gulp.src('dist/js/seattle.js')
    .pipe(uglify())
    .pipe(rename('seattle.min.js'))
    .pipe(gulp.dest('dist/js'))
});

// Default Javascript build task
gulp.task('build-js', function(callback) {
    runSequence('concat-js', callback);
});

// configure which files to watch and what tasks to use on file changes
gulp.task('watch', function() {
    gulp.watch('coffee/**/*.js', ['brew-coffee']);
    gulp.watch('inc/js/**/*.js', ['build-js']);
    gulp.watch('inc/sass/**/*.scss', ['build-css']);
});

gulp.task('bower', function() {
    return bower({ cmd: 'update'});
});

// Default build task
gulp.task('build', function(callback) {
    runSequence(
        ['bower',],
        ['copy-fonts', 'copy-bower', 'copy-img'],
        ['build-css', 'build-js'],
        ['shrink-js', 'copy-bower'], callback
    );
});
