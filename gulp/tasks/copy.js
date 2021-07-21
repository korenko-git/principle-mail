import {src, dest} from 'gulp';
import {buildDir, path} from '../paths.js';

function copy() {
  return src([
    path.src.php,
    path.src.env,
  ])
    .pipe(dest(buildDir));
}

export default copy;


