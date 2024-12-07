const mix = require('laravel-mix');

mix.js('resources/js/frontend.js', 'public/js')
   .vue();

mix.js('resources/js/backend.js', 'public/js')
   .vue();