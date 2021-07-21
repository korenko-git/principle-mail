
import {src, dest} from 'gulp';
import {path} from '../paths';

function fonts() {
  return src(path.src.fonts)
    .pipe(dest(path.build.fonts));
}

export default fonts;
