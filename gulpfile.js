const gulp       = require('gulp');
const notify     = require('gulp-notify');
const plumber    = require('gulp-plumber');
const rename     = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');

function onError( err ) {
	notify.onError({
		title: 'Gulp error in ' + err.plugin,
		message: err.toString(),
		sound: false
	})(err);
};

function sassLint( done ) {
	const sasslint = require('gulp-sass-lint')

	gulp.src([
			'src/scss/**/*.scss',
			'!src/scss/vendor/**.*'
		])
		.pipe( plumber({ errorHandler: onError }) )
		.pipe( sasslint() )
		.pipe( sasslint.format() )
		.pipe( sasslint.failOnError() );

	done();
};

function sass( done ) {
	const sass = require('gulp-sass');

	gulp.src('src/scss/*.scss')
		.pipe( plumber({ errorHandler: onError }) )
		.pipe( sourcemaps.init() )
		.pipe( sass({ outputStyle: 'expanded' }).on( 'error', sass.logError ) )
		.pipe( sourcemaps.write('./') )
		.pipe( gulp.dest('css/') );

	done();
};

function css( done ) {
	const cleanCSS     = require('gulp-clean-css');
	const autoprefixer = require('gulp-autoprefixer');

	gulp.src([
			'css/*.css',
			'!css/*.min.css'
		])
		.pipe( plumber({ errorHandler: onError }) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( autoprefixer({
			cascade: false
		}) )
		.pipe( cleanCSS({
			level: {
				2: {
					all: false,
					mergeIntoShorthands: true,
					mergeMedia: true
				}
			}
		}) )
		.pipe( rename({
			suffix: '.min'
		}) )
		.pipe( sourcemaps.write('./') )
		.pipe( gulp.dest('css/') );

	done();
};

function jsHint() {
	const jshint = require('gulp-jshint');

	return gulp
		.src( 'src/js/**/*.js' )
		.pipe( jshint() )
		.pipe( jshint.reporter('jshint-stylish') );
};

function js( done ) {
	const include = require('gulp-include');
	const uglify  = require('gulp-uglify');

	gulp
		.src( 'src/js/*.js' )
		.pipe( include() )
		.pipe( rename({
			suffix: '.min'
		}) )
		.pipe( plumber({ errorHandler: onError }) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( uglify() )
		.pipe( sourcemaps.write('./') )
		.pipe( gulp.dest('js/') );

	done();
};

const styles  = gulp.series( sassLint, sass, css );
const scripts = gulp.series( jsHint, js );

const build = gulp.parallel( styles, scripts );

exports.sassLint = sassLint;
exports.sass     = sass;
exports.css      = css;
exports.jsHint   = jsHint;
exports.js       = js;
exports.styles   = styles;
exports.scripts  = scripts;

exports.default = build;
