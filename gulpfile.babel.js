import babel from 'gulp-babel';
import concat from 'gulp-concat';
import sass from 'gulp-sass';
import del from 'del';
import gulp from 'gulp';
import browserSync from 'browser-sync';

const server = browserSync.create();

const paths = {
    scripts: {
        src: 'assets/js/*.js',
        dest: 'dist/js/'
    },
    styles: {
        src: 'assets/scss/*/*.scss',
        dest: 'dist/css/'
    }
};

const clean = () => del(['dist']);

const styles = () => {
    return gulp.src(paths.styles.src)
        .pipe(sass())
        .on('error', sass.logError)
        .pipe(gulp.dest(paths.styles.dest))
}

const scripts = () => {
    return gulp.src(paths.scripts.src, {
            sourcemaps: true
        })
        .pipe(babel())
        .pipe(concat('main.min.js'))
        .pipe(gulp.dest(paths.scripts.dest));
}

const reload = (done) => {
    server.reload();
    done();
}

const serve = (done) => {
    console.log(process.argv[1]);
    server.init({
        proxy: 'localhost/identifixe'
    });
    done();
}

const watch = () => {
    gulp.watch(paths.styles.src, gulp.series(styles, reload));
    gulp.watch(paths.scripts.src, gulp.series(scripts, reload));
}

const dev = gulp.series(clean, styles, scripts, serve, watch);

export default dev;