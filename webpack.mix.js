const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/pages/productOverview.scss', 'public/css/pages')
    .sass('resources/sass/pages/about.scss', 'public/css/pages')
    .sass('resources/sass/pages/termsAndPrivacy.scss', 'public/css/pages')
    .sass('resources/sass/pages/products.scss', 'public/css/pages')
    .sass('resources/sass/pages/contact.scss', 'public/css/pages')
    .sass('resources/sass/pages/home.scss', 'public/css/pages')
    .sass('resources/sass/pages/configuration.scss', 'public/css/pages')
    .sass('resources/sass/pages/purchases.scss', 'public/css/pages');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .js('resources/js/modules/slider.js', 'public/js/modules')
    .js('resources/js/modules/images.js', 'public/js/modules')
    .js('resources/js/modules/categoriesHome.js', 'public/js/modules')
    .js('resources/js/modules/productOverview.js', 'public/js/modules')
    .js('resources/js/modules/shoppingcart.js', 'public/js/modules')
    .js('resources/js/admin/alerts.js', 'public/js/admin');

if (mix.inProduction()) {
    mix.version();
}
