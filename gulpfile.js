var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	cleanCSS = require('gulp-clean-css'),
	sass = require('gulp-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	watch = require('gulp-watch');
	
var jsList = [ 
    // './js/jquery.maskedinput.js', 
    // './js/magnific.js', 
    './js/common.js',
];

gulp.task('test', function() {
   console.log('Все работает');
});

gulp.task('sass', function(){
	return gulp.src('./css/*.scss')
		.pipe(sass({
			outputStyle: 'compressed'
		}).on('error', sass.logError))
		.pipe(gulp.dest('./css'));
});
gulp.task('prefix', function () {
    return gulp.src('./css/*.css')
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('dist'));
});

gulp.task("css-bundle", function() {
    gulp.src('./dist/*.css')
    .pipe(cleanCSS({
            compatibility: "ie8", 
        })
    )
    .pipe(concat("bundle.css", {newLine: ""}))
    .pipe(gulp.dest('./static/css/'))
});

gulp.task('js-bundle', function() {
  gulp.src(jsList)
    .pipe(concat('bundle.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./static/js/'))
});