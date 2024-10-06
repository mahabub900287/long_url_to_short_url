const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .options({
       processCssUrls: false
   })
   .browserSync('localhost:8000')
   .sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
