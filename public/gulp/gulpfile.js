'use strict';

// General
const gulp =                				require('gulp');
// const browserSync =         				require('browser-sync').create();
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

// Constants
// const themeName =               	'assets';
// const hostName =                  	'colloqia.dev';

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
  return gulp.src('../css/style.sass')
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
  // .pipe(cssnano())
  // Destination name.
  .pipe(rename('theme.min.css'))
  // Write CSS to output file.
  .pipe(gulp.dest('../css/'))
  // Browsersync CSS injecting.
  // .pipe(browserSync.stream())
  // Notify.
  .pipe(notifySuccess('Compiled "theme.min.css"'));
});

gulp.task('default', function() {
  // Initialize Browsersync.
  // browserSync.init({
  //   ghostMode: false,
  //   open: false,
  //   notify: false,
  //   proxy: hostName,
  // });

  // Watch SASS-file changes.
  gulp.watch('../css/**/*.sass', ['compile-css']);
});
