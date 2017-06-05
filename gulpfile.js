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
        styles: 'css/build/',
        scripts: 'js/build/'
    },
    dev: {
        js: 'js/main.js',
        less: 'css/*.less',
        blocks: 'css/blocks/*/*.less',
        vendorCss: 'css/vendor/*.css',
        vendorSaas: 'css/vendor/*.scss',
    }
}

gulp.task('styles', function () {
    return gulp.src([
        path.dev.vendorCss,
        path.dev.less,
        path.dev.blocks
    ])
    .pipe(concat('__main.less'))
    .pipe(less())
    .pipe(prefixer())
    .on('error', console.log)
    .pipe(gulp.dest(path.build.styles))
    .pipe(cleanCSS())
    .pipe(rename('_main.css'))
    .pipe(gulp.dest(path.build.styles));
});

gulp.task('scripts', function () {

    return gulp.src([
        path.dev.js
    ])
    .pipe(concat('__main.js'))
    .pipe(gulp.dest(path.build.scripts))
    .pipe(uglify().on('error', function(e){
        console.log(e);
    }))
    .pipe(rename('_main.js'))
    .pipe(gulp.dest(path.build.scripts))
});

gulp.task('build', ['scripts', 'styles'], function () {});

gulp.task('watch', function(){
    watch([path.dev.less, path.dev.blocks], function(event, cb) {
        gulp.start('styles');
    });
});
