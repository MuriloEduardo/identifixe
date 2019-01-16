import gulp from 'gulp';
import sass from 'gulp-sass';
import browserSync from 'browser-sync';

const server = browserSync.create();

const paths = {
    styles: {
        src: 'assets/scss/**/*.scss',
        dest: 'assets/css/'
    }
};

const fontawesome = () => {
    return gulp.src('node_modules/@fortawesome/fontawesome-free/webfonts/*')
        .pipe(gulp.dest('assets/fonts/webfonts'));
}

const styles = () => {
    return gulp.src(paths.styles.src)
        .pipe(sass())
        .on('error', sass.logError)
        .pipe(gulp.dest(paths.styles.dest))
}

const reload = (done) => {
    server.reload();
    done();
}

const serve = (done) => {
    server.init({
        proxy: 'localhost/identifixe'
    });
    done();
}

const watch = () => gulp.watch(paths.styles.src, gulp.series(styles, reload));

const dev = gulp.series(fontawesome, styles, serve, watch);

export default dev;