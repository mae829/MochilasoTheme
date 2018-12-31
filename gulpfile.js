var gulp       = require('gulp');
var notify     = require('gulp-notify');
var plumber    = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');

var onError = function( err ) {
	notify.onError({
		title: 'Gulp error in ' + err.plugin,
		message: err.toString(),
		sound: false
	})(err);
};

gulp.task( 'sass-lint', function() {
	var sassLint = require('gulp-sass-lint')

	gulp.src([
			'src/scss/**/*.scss',
			'!src/scss/vendor/**.*'
		])
		.pipe( plumber({ errorHandler: onError }) )
		.pipe( sassLint() )
		.pipe( sassLint.format() )
		.pipe( sassLint.failOnError() );
});

gulp.task( 'sass', ['sass-lint'], function( callback ) {
	var sass = require('gulp-sass');

	gulp.src('src/scss/*.scss')
		.pipe( plumber({ errorHandler: onError }) )
		.pipe( sourcemaps.init() )
		.pipe( sass({ outputStyle: 'expanded' }).on( 'error', sass.logError ) )
		.pipe( sourcemaps.write('./') )
		.pipe( gulp.dest('css/') )
		.on( 'end', callback );
});

gulp.task( 'css', ['sass'], function() {
	var rename   = require('gulp-rename');
	var cleanCSS = require('gulp-clean-css');

	gulp.src([
			'css/*.css',
			'!css/*.min.css'
		])
		.pipe( plumber({ errorHandler: onError }) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( cleanCSS({
			level: {
				2: {
					all: false,
					mergeIntoShorthands: true,
					mergeMedia: true
				}
			}
		}) )
		.pipe(
			rename({
				suffix: '.min'
			})
		)
		.pipe( sourcemaps.write('./') )
		.pipe( gulp.dest('css/') );
});

gulp.task( 'js-hint', function() {
	var jshint = require('gulp-jshint');

	gulp.src('src/js/**/*.js')
		.pipe( jshint() )
		.pipe( jshint.reporter('jshint-stylish') );
});

gulp.task( 'js', ['js-hint'], function () {
	var include = require('gulp-include');
	var rename  = require('gulp-rename');
	var uglify  = require('gulp-uglify');

	gulp.src('src/js/*.js')
		.pipe( include() )
		.pipe(
			rename({
				suffix: '.min'
			})
		)
		.pipe( plumber({ errorHandler: onError }) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( uglify() )
		.pipe( sourcemaps.write('./') )
		.pipe( gulp.dest('js/') );
});

gulp.task( 'build', ['css', 'js'] );

gulp.task( 'default', ['build'] );
