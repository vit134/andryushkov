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
            article: 'css/article/build/',
            js: 'js/build/'
        },
        admin: {
            css: 'admin_v2/css/build/',
            js: 'admin_v2/js/build/'
        }
    },
    dev: {
        site: {
            js: 'js/main.js',
            jsPages: 'js/pages/*/*.js',
            widgets: 'js/widgets/*.js',
            less: 'css/*.less',
            blocks: 'css/blocks/*/*.less',
            pages: 'css/pages/*/*.less',
            vendorCss: 'css/vendor/*.css',
            article: 'css/article/main.less'
        },
        admin: {
            js: 'admin_v2/js/main.js',
            jsPages: 'admin_v2/js/pages/*/*.js',
            less: 'admin_v2/css/*.less',
            blocks: 'admin_v2/css/blocks/*/*.less',
            pages: 'admin_v2/css/pages/*/*.less',
            vendorCss: 'admin_v2/css/vendor/*.css'
        }
    }
}

gulp.task('styles', function () {
    return gulp.src([
        path.dev.site.less,
        path.dev.site.blocks,
        path.dev.site.pages,
        path.dev.site.article
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

gulp.task('styles-article', ['styles'], function () {
    return gulp.src([path.dev.site.article])
    .pipe(concat('__main.less'))
    .pipe(less())
    .pipe(prefixer())
    .on('error', console.log)
    .pipe(gulp.dest(path.build.site.article))
    .pipe(cleanCSS())
    .pipe(rename('_main.css'))
    .pipe(gulp.dest(path.build.site.article));
});

gulp.task('styles-admin', function () {
    return gulp.src([
        path.dev.admin.vendorCss,
        path.dev.admin.less,
        path.dev.admin.blocks,
        path.dev.admin.pages
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
        path.dev.site.js,
        path.dev.site.jsPages,
        path.dev.site.widgets
    ])
    //.pipe(concat('__main.js'))
    .pipe(gulp.dest(path.build.site.js))
    .pipe(uglify().on('error', function(e){
        console.log(e);
    }))
    //.pipe(rename('_main.js'))
    .pipe(gulp.dest(path.build.site.js))
});

gulp.task('scripts-admin', function () {
    return gulp.src([
        path.dev.admin.js,
        path.dev.admin.jsPages
    ])
    //.pipe(concat('__main.js'))
    .pipe(gulp.dest(path.build.admin.js))
    /*.pipe(uglify().on('error', function(e){
        console.log(e);
    }))*/
    //.pipe(rename('_main.js'))
    .pipe(gulp.dest(path.build.admin.js))
});

gulp.task('build', ['scripts', 'styles'], function () {});

gulp.task('watch', function(){
    watch([path.dev.site.less, path.dev.site.blocks], function(event, cb) {
        gulp.start('styles');
    });
});

gulp.task('watch-admin', function(){
    watch([path.dev.admin.less, path.dev.admin.pages, path.dev.admin.blocks], function(event, cb) {
        gulp.start('styles');
    });
});
