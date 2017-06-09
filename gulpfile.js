/*eslint no-console: 0*/
'use strict'

var gulp = require('gulp')
  , uglify = require('gulp-uglify')
  , concat = require('gulp-concat')
  , rename = require('gulp-rename')
  , cleanCSS = require('gulp-clean-css')
  , less = require('gulp-less')
  , watch = require('gulp-watch')
  , prefixer = require('gulp-autoprefixer')
  //, sass = require('gulp-sass')
  ;

var path = {
    build: {
        site: {
            css: 'css/build/',
            js: 'js/build/'
        },
        admin: {
            css: 'admin/css/build/',
            js: 'admin/js/build/'
        }
    },
    dev: {
        site: {
            js: 'js/main.js',
            less: 'css/*.less',
            blocks: 'css/blocks/*/*.less',
            vendorCss: 'css/vendor/*.css'
        },
        admin: {
            js: 'admin/js/main.js',
            less: 'admin/css/*.less',
            blocks: 'admin/css/blocks/*/*.less',
            vendorCss: 'admin/css/vendor/*.css'
        }
    }
}

gulp.task('styles', function () {
    return gulp.src([
        path.dev.site.vendorCss,
        path.dev.site.less,
        path.dev.site.blocks
    ])
    .pipe(concat('__main.less'))
    .pipe(less())
    .pipe(prefixer())
    .on('error', console.log)
    .pipe(gulp.dest(path.build.site.css))
    .pipe(cleanCSS())
    .pipe(rename('_main.css'))
    .pipe(gulp.dest(path.build.site.css));
});

gulp.task('styles-admin', function () {
    return gulp.src([
        path.dev.admin.vendorCss,
        path.dev.admin.less,
        path.dev.admin.blocks
    ])
    .pipe(concat('__main.less'))
    .pipe(less())
    .pipe(prefixer())
    .on('error', console.log)
    .pipe(gulp.dest(path.build.admin.css))
    .pipe(cleanCSS())
    .pipe(rename('_main.css'))
    .pipe(gulp.dest(path.build.admin.css));
});

gulp.task('scripts', function () {
    return gulp.src([
        path.dev.site.js
    ])
    .pipe(concat('__main.js'))
    .pipe(gulp.dest(path.build.site.scripts))
    .pipe(uglify().on('error', function(e){
        console.log(e);
    }))
    .pipe(rename('_main.js'))
    .pipe(gulp.dest(path.build.site.scripts))
});

gulp.task('scripts-admin', function () {
    return gulp.src([
        path.dev.admin.js
    ])
    .pipe(concat('__main.js'))
    .pipe(gulp.dest(path.build.admin.scripts))
    .pipe(uglify().on('error', function(e){
        console.log(e);
    }))
    .pipe(rename('_main.js'))
    .pipe(gulp.dest(path.build.admin.scripts))
});

gulp.task('build', ['scripts', 'styles'], function () {});

gulp.task('watch', function(){
    watch([path.dev.site.less, path.dev.site.blocks], function(event, cb) {
        gulp.start('styles');
    });
});

gulp.task('watch-admin', function(){
    watch([path.dev.admin.less, path.admin.site.blocks], function(event, cb) {
        gulp.start('styles');
    });
});
