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

const dev = gulp.series(styles, serve, watch);

export default dev;