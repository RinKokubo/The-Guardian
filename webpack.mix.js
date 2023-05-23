const mix = require('laravel-mix');
require('tailwindcss');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .sass('resources/sass/app.scss', 'public/css');
