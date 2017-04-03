var gulp       = require('gulp'),
		sass       = require('gulp-sass'),
		watch      = require('gulp-watch'),
		livereload = require('gulp-livereload');

gulp.task('sass', function(){
   gulp.src('scss/*.scss')
   		.pipe(sass())
    	.pipe(gulp.dest('./'))
    	.pipe(livereload());
});

gulp.task('watch', function() {
  // Watch .scss files
  livereload.listen();
  gulp.watch('scss/*.scss', ['sass']);
});

gulp.task('default', ['watch'], function() {});