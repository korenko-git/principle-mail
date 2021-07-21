import {src, dest} from 'gulp';
import plumber from 'gulp-plumber';
import fileInclude from 'gulp-file-include';
import htmlValidator from 'gulp-w3c-html-validator';
import inject from 'gulp-inject';
import {path, faviconsHTMLPath} from '../paths';

function layouts() {
  return src(path.src.html)
    .pipe(plumber())
    .pipe(fileInclude({
      prefix: '@@',
      basepath: '@file',
    }))
    .pipe(htmlValidator())
    .pipe(inject(src([faviconsHTMLPath]), {
      starttag: '<!-- inject:head:{{ext}} -->',
      transform: function(filePath, file) {
        return file.contents.toString('utf8');
      },
    }))
    .pipe(dest(path.build.html));
}

export default layouts;
