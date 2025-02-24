const domain = 'https://ebi-digitalstudio.jp';
const rootPath = '/';
const siteRoot = `${domain}${rootPath}`;
const assetRoot = '/assets/';
const dirs = {
  dist: {
    root: `./dist`,
    siteRoot: `./dist${rootPath}`,
    assets: `./dist${assetRoot}`,
    js: `./dist${assetRoot}js`,
    css: `./dist${assetRoot}css`,
    img: `./dist${assetRoot}img`,
    font: `./dist${assetRoot}font`,
    icons: `./dist${assetRoot}icons`,
  },
  src: {
    root: './src',
    ejs: {
      root: './src/ejs',
      page: './src/ejs/pages',
      svg: './src/ejs/modules/svg',
    },
    assets: './src/assets',
    js: './src/assets/js',
    scss: './src/assets/scss',
    img: './src/assets/img',
    font: './src/assets/font',
    icons: './src/assets/icons',
  },
};

// env
var isProduction = process.env.NODE_ENV === 'production';

// const { src, dest, watch, series, parallel } = require('gulp');
const gulp = require('gulp');
const path = require('path');
const fs = require('fs');
const del = require('del');
const plumber = require('gulp-plumber');
const gulpIf = require('gulp-if');
const rename = require('gulp-rename');

// server
const browserSync = require('browser-sync');
const ssi = require('browsersync-ssi');

// webpack
const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const webpackConfig = require('./webpack.config');

// css
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const bulkSass = require('gulp-sass-glob-use-forward');
const autoprefixer = require('autoprefixer');
const cssdeclsort = require('css-declaration-sorter');
const cleanCss = require('gulp-clean-css');

// ejs
const ejs = require('gulp-ejs');
const data = require('gulp-data');
const JSON5 = require('json5');
const htmlmin = require('gulp-htmlmin');
const ejsDistReg = new RegExp(
  __dirname + '|' + dirs.src.ejs.page.replace(/^\.\//, '/'),
  'g'
);
const ejsSrcReg = new RegExp(
  __dirname + '|' + dirs.src.ejs.root.replace(/^\.\//, '/'),
  'g'
);

// images
const changed = require('gulp-changed');
const imagemin = require('gulp-imagemin');
const pngquant = require('imagemin-pngquant');
const mozjpeg = require('imagemin-mozjpeg');
const imgExt = '{jpg,jpeg,png,gif,svg,webp}';

// task: webpack
const bundleJs = () => {
  // webpackStream の第2引数に webpack を渡す
  return webpackStream(webpackConfig, webpack).pipe(
    gulp.dest(`${dirs.dist.js}`)
  );
};

// task: css
const compileSass = (done) => {
  const postcssPlugins = [
    autoprefixer({
      cascade: false,
      grid: 'autoplace',
    }),
    cssdeclsort({ order: 'smacss' /* smacss, alphabetical, concentric-css */ }),
  ];
  gulp
    .src(
      `${dirs.src.scss}/**/*.scss`,
      !isProduction ? { sourcemaps: true /* init */ } : {}
    )
    .pipe(plumber())
    .pipe(bulkSass())
    .pipe(sass({ outputStyle: 'expanded' }))
    .pipe(postcss(postcssPlugins))
    .pipe(gulpIf(isProduction, cleanCss()))
    .pipe(
      gulp.dest(
        `${dirs.dist.css}`,
        !isProduction ? { sourcemaps: './sourcemaps' /* write */ } : {}
      )
    )
    .pipe(browserSync.stream());
  done();
};

// task: ejs
const compileEjs = (done) => {
  // const actionsDataJson5 = `${dirs.src.ejs.root}/xxx.json5`;
  // let actionsData = JSON5.parse(fs.readFileSync(actionsDataJson5, 'utf8'));
  // actionsData = actionsData.sort((a, b) => a.order - b.order);
  const htmlMinOption = {
    // 余白を除去する
    collapseWhitespace: true,
    // HTMLコメントを除去する
    removeComments: true,
  };
  gulp
    .src(`${dirs.src.ejs.page}/**/*.html.ejs`)
    .pipe(plumber())
    .pipe(
      data((file) => {
        return {
          isProduction,
          ...getPageData(file),
          // dataJson5,
        };
      })
    )
    .pipe(ejs())
    .pipe(
      rename((file) => {
        file.basename = file.basename.replace(/\.html$/, '');
        file.extname = '.html';
      })
    )
    // .pipe(gulpIf(isProduction,
    //   htmlmin(htmlMinOption)
    // ))
    // .pipe(htmlmin(htmlMinOption))
    .pipe(gulp.dest(dirs.dist.siteRoot));
  done();
};

const getPageData = (file) => {
  const absolutePath = file.path
    .replace(ejsDistReg, '')
    .replace(/\.html\.ejs$/, '.html')
    .replace(/\/index\.html/, '/');

  const absolutePathSrc = file.path
    .replace(ejsSrcReg, '')
    .replace(/\.html\.ejs$/, '.html')
    .replace(/\/index\.html/, '/');
  // const fullPath = rootPath.replace(/\/$/, '') + absolutePathSrc;
  const ejsRelativePath = '../'.repeat([absolutePathSrc.split('/').length - 2]);

  const assetsPath = `${dirs.dist.assets.replace(dirs.dist.root, '')}`;

  return {
    domain,
    siteRoot,
    absolutePath,
    // fullPath,
    rootPath,
    assetsPath,
    ejsRelativePath,
  };
};

// task: image minify
const imageMinify = (done) => {
  gulp
    .src([
      `${dirs.src.img}/**/*.${imgExt}`,
      `!${dirs.src.img}/**/fv-img-1.png`,
      // `!${dirs.src.img}/**/*-no.svg`,
      `${dirs.src.ejs.svg}/**/*.${imgExt}`,
    ])
    .pipe(
      gulpIf(
        isProduction,
        imagemin([
          pngquant({ quality: [0.65, 0.8], speed: 1 }),
          mozjpeg({ quality: 80 }),
          imagemin.svgo(),
          imagemin.gifsicle(),
        ])
      )
    )
    .pipe(gulp.dest(dirs.dist.img));
  done();
};

// task: file copy
const fileCopy = (done) => {
  gulp
    .src(
      [
        `${dirs.src.data}/**/*`,
        `${dirs.src.font}/**/*`,
        `${dirs.src.icons}/**/*`,
        `${dirs.src.movie}/**/*`,
        `${dirs.src.img}/**/*.mp4`,
        `${dirs.src.img}/**/*.cur`,
        // `${dirs.src.img}/**/*-no.svg`,
      ],
      { base: dirs.src.assets }
    )
    .pipe(gulp.dest(dirs.dist.assets));
  done();
};

// task: server
const url = require('url');
const runServer = (done) => {
  browserSync.init({
    server: {
      baseDir: dirs.dist.root,
      notify: false,
      middleware: [
        ssi({
          baseDir: __dirname + dirs.dist.root,
          ext: '.html',
        }),
      ],
    },
    port: 8080,
    open: false,
    reloadOnRestart: true,
    ghostMode: false,
    https: true,
  });
  done();
};

// task: reload
const browserReload = (done) => {
  browserSync.reload();
  done();
};

// task: ビルドファイル除去
const cleanFiles = (done) => {
  return del(
    [`${dirs.dist.root}**/*.html`, dirs.dist.js, dirs.dist.css, dirs.dist.img],
    done
  );
};

// task: watch
const watchFiles = () => {
  gulp.watch(`${dirs.src.js}/**/*.js`, gulp.series(bundleJs, browserReload));
  gulp.watch(`${dirs.src.scss}/**/*.scss`, gulp.series(compileSass));
  gulp.watch(
    [`${dirs.src.ejs.root}/**/*.ejs`, `${dirs.src.ejs.root}/**/*.json5`],
    gulp.series(compileEjs, browserReload)
  );
  gulp.watch(
    [
      `${dirs.src.img}/**/*.${imgExt}`,
      // `!${dirs.src.img}/**/*-no.svg`,
      `${dirs.src.ejs.svg}/**/*.${imgExt}`,
    ],
    gulp.series(imageMinify, browserReload)
  );
  gulp.watch(
    [
      `${dirs.src.data}/*`,
      `${dirs.src.font}/*`,
      `${dirs.src.icons}/*`,
      `${dirs.src.img}/**/*.mp4`,
      `${dirs.src.img}/**/*.cur`,
    ],
    gulp.series(fileCopy, browserReload)
  );
};

exports.sass = compileSass;
if (isProduction) {
  exports.default = gulp.series(
    cleanFiles,
    imageMinify,
    gulp.parallel(
      compileSass,
      compileEjs,
      bundleJs,
      fileCopy,
      watchFiles,
      runServer
    )
  );
} else {
  exports.default = gulp.series(
    cleanFiles,
    imageMinify,
    gulp.parallel(
      compileSass,
      compileEjs,
      bundleJs,
      fileCopy,
      watchFiles,
      runServer
    )
  );
}
