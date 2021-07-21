import del from 'del';
import {buildDir} from '../paths.js';

function clean() {
  return del(buildDir + '/*');
}

export default clean;
