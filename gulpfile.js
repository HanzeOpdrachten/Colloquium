'use strict';

// General
const gulp =                				require('gulp');
const notify =              				require('gulp-notify');

// CSS
const sass =                				require('gulp-sass');
const bourbonIncludePaths = 				require('bourbon').includePaths;
const neatIncludePaths =    				require('bourbon-neat').includePaths;
const cssnano =             				require('gulp-cssnano');
const autoprefixer =        				require('gulp-autoprefixer');
const cheerio =             				require('gulp-cheerio');

// JavaScript
const uglify =              				require('gulp-uglify');
const concat =              				require('gulp-concat');
const rename =              				require('gulp-rename');

function notifySuccess(message) {
  return notify({
    icon: 'notification.png',
    sound: false,
    title: 'Success',
    message: message
  });
}

function notifyFailure(message, error) {
  return notify.onError({
    icon: 'notification.png',
    sound: false,
    title: 'Failure',
    message: message + error
  })(error);
}

gulp.task('compile-css', function() {
  // Read sass.
  return gulp.src('resources/assets/sass/style.sass')
  // Convert to CSS by applying SASS.
  .pipe(sass({
    // Set include paths for Bourbon and Neat.
    includePaths: [bourbonIncludePaths, neatIncludePaths]
  })).on('error', sass.logError).on('error', function (error) {
    notifyFailure('Error compiling "style.sass"', error);
    this.emit('end');
  })
  // Autoprefix CSS
  .pipe(autoprefixer())
  // Compress CSS.
  .pipe(cssnano())
  // Destination name.
  .pipe(rename('theme.min.css'))
  .pipe(rename('login.css'))
  // Write CSS to output file.
  .pipe(gulp.dest('public/css/'))
  // Notify.
  .pipe(notifySuccess('Compiled "theme.min.css"')
  .pipe(notifySuccess('Compiled "login.css"'));
});

gulp.task('default', function() {
  // Watch SASS-file changes.
  gulp.watch('resources/assets/sass/**/*.sass', ['compile-css']);

  // Watch JS-file changes.
  gulp.watch('resources/assets/js/**/*.js', ['compile-js']);
});


gulp.task('compile-js', function() {
  gulp.src(['resources/assets/js/app.js'])
  .pipe(concat('app.min.js'))
  .pipe(uglify())
  .pipe(gulp.dest('public/js/'))
});
