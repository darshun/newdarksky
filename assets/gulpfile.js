// Plugins
var gulp = require('gulp'),
	sass = require('gulp-ruby-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	cleancss = require('gulp-clean-css'),
	rename = require('gulp-rename'),
	notify = require('gulp-notify'),
	cache = require('gulp-cache')

// Compile all the styles
gulp.task('styles', function() {
	return sass('scss/bootstrap.scss', { style: 'expanded' })
		.pipe(autoprefixer('last 3 versions'))
		.pipe(gulp.dest('dist/css/'))
		.pipe(rename({suffix: '.min'}))
		.pipe(cleancss())
		.pipe(gulp.dest('dist/css/'))
		.pipe(notify({ message: '^._.^ Styles Compiled!' }));
});

// Watch for updates; compile on save
gulp.task('watch', function() {
	gulp.watch('scss/**/*.scss', ['styles']);
});
