import {src, dest} from 'gulp';
import plumber from 'gulp-plumber';
import fileInclude from 'gulp-file-include';
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';
import babel from 'gulp-babel';
import uglify from 'gulp-uglify';

import {path} from '../paths';
import {browserSyncObject} from '../browserSync';

function scripts() {
  return src(path.src.js)
    .pipe(plumber())
    .pipe(fileInclude({
      prefix: '@@',
      basepath: '@file',
    }))
    .pipe(dest(path.build.js))
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ['@babel/preset-env'],
    }))
    .pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(dest(path.build.js))
    .pipe(browserSyncObject.stream());
}

export default scripts;
