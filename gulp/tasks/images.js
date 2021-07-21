
import {src, dest} from 'gulp';
import newer from 'gulp-newer';
import imagemin from 'gulp-imagemin';
import imageresize from 'gulp-image-resize'; // need to install imagemagick or graphicsmagick
import pngquant from 'imagemin-pngquant';
import rename from 'gulp-rename';

import {path} from '../paths';

function images() {
  return src(path.src.img)
    .pipe(newer(path.build.img))
    .pipe(imagemin([
      imagemin.mozjpeg({quality: 75, progressive: true}),
      imagemin.gifsicle({interlaced: true}),
      pngquant(),
      imagemin.svgo({plugins: [{removeViewBox: false}]}),
    ]))
    .pipe(dest(path.build.img))
    .pipe(rename({suffix: '.thumb'}))
    .pipe(imageresize({
      width: 369,
      upscale: false,
    }))
    .pipe(dest(path.build.img));
}

export default images;
