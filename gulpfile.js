var gulp 			= require('gulp');
	cleanCss 		= require('gulp-clean-css')
	rename 			= require('gulp-rename')
	uglify			= require('gulp-uglify');


/** minify css  **/
gulp.task('minifyCss',function(){


	gulp.src('public/css/style.css')
	.pipe(cleanCss({compatibility:'ie8'}))
	.pipe(rename('app.min.css'))
	.pipe(gulp.dest('public/css/'));

	gulp.src('public/admin/css/sb-admin.css')
	.pipe(cleanCss({compatibility:'ie8'}))
	.pipe(rename('app.admin.min.css'))
	.pipe(gulp.dest('public/admin/css/'));
	
	console.log('css minification completed...');


});


/** uglify js  **/
gulp.task('minifyJs',function(){


	
	gulp.src('public/js/scripts.js')
	.pipe(uglify())
	.pipe(rename('app.min.js'))
	.pipe(gulp.dest('public/js/'));

	gulp.src('public/admin/js/scripts.js')
	.pipe(uglify())
	.pipe(rename('app.admin.min.js'))
	.pipe(gulp.dest('public/admin/js/'));

	console.log('js uglify completed...');

});




/** default task  **/
gulp.task('test',function(){


	console.log('testing the app');

});