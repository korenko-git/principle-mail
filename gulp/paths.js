const srcDir = 'src';
const buildDir = 'dest';

const path = {
  build: {
    html: buildDir + '/',
    js: buildDir + '/assets/js/',
    css: buildDir + '/assets/css/',
    img: buildDir + '/assets/img',
    fonts: buildDir + '/assets/fonts/',
    favicon: buildDir + '/',
  },
  src: {
    html: srcDir + '/*.html',
    js: srcDir + '/js/*.js',
    style: srcDir + '/style/main.scss',
    img: srcDir + '/img/**/*.{jpg,png,svg}',
    fonts: srcDir + '/fonts/**/*.*',
    favicon: srcDir + '/favicon.png',
    php: srcDir + '/*.php',
    env: srcDir + '/.env',
  },
  watch: {
    html: srcDir + '/**/*.html',
    js: srcDir + '/js/**/*.js',
    css: srcDir + '/style/**/*.scss',
    img: srcDir + '/img/**/*.*',
    fonts: srcDir + '/fonts/**/*.*',
    favicon: srcDir + '/favicon.png',
    php: srcDir + '/*.php',
    env: srcDir + '/.env',
  },
};

const faviconsHTML = 'favicons.html';
const faviconsHTMLPath = buildDir + '/' + faviconsHTML;

export {
  srcDir,
  buildDir,
  path,
  faviconsHTML,
  faviconsHTMLPath,
};
