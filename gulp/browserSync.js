import {create as bsCreate} from 'browser-sync';
import {buildDir} from './paths';

const browserSyncObject = bsCreate();

function browserSync() {
  browserSyncObject.init({
    server: {
      baseDir: buildDir + '/',
      notify: false,
    },
    port: 3000,
  });
}

export {
  browserSyncObject,
  browserSync,
};
