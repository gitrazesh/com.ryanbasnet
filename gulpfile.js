var gulp 			= require('gulp');
	cleanCss 		= require('gulp-clean-css')
	rename 			= require('gulp-rename')
	uglify			= require('gulp-uglify');


/** minify css  **/
gulp.task('minifyCss',function(){


	gulp.src('public/css/app.css')
	.pipe(cleanCss({compatibility:'ie8'}))
	.pipe(rename('app.min.css'))
	.pipe(gulp.dest('public/css/'));

	console.log('css minification completed...');


});


/** uglify js  **/
gulp.task('minifyJs',function(){


	
	gulp.src('public/js/app.js')
	.pipe(uglify())
	.pipe(rename('app.min.js'))
	.pipe(gulp.dest('public/js/'));

	

	console.log('js uglify completed...');

});




/** default task  **/
gulp.task('test',function(){


	console.log('testing the app');

});