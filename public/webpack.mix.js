const mix = require('laravel-mix');

// Compilar CSS
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'), // se não usar, remova
]);

// Compilar JS
mix.js('resources/js/app.js', 'public/js');

// Copiar Bootstrap CSS/JS compilados
// Isso vai incluir Bootstrap no seu app.css e app.js
