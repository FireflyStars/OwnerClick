const webpack = require('webpack');
const mix = require('laravel-mix');
// require('laravel-mix-purgecss');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.webpackConfig({
    module: {
        rules: [
            {
                // Matches all PHP or JSON files in `resources/lang` directory.
                test: /resources[\\\/]lang.+\.(php|json)$/,
                loader: 'laravel-localization-loader',
            }
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        }),
        new webpack.ContextReplacementPlugin(
            /moment[\/\\]locale/,
            // A regular expression matching files that should be included
            /(tr)\.js/
        ),

    ]
});

//     .purgeCss({
//     safelist: {standard: [/fa*/, /-active$/, /-enter$/, /-leave-to$/, /show$/, /toggled$/, /'visible'$/, /'show'$/, /'close-layer'$/, /-open$/, /-off$/]},
// });
// if (mix.inProduction()) {


mix.js([
    'node_modules/@popperjs/core/dist/esm/popper.js',
    'resources/js/app.js',
    'node_modules/bootstrap-material-design/dist/js/bootstrap-material-design.min.js',
    'resources/material/js/plugins/perfect-scrollbar.jquery.min.js',
    // 'node_modules/moment/min/locales.js',
    // 'node_modules/moment/moment.js',
    'resources/material/js/plugins/jquery.validate.min.js',
    'resources/material/js/plugins/jquery.bootstrap-wizard.js',
    'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js',
    'resources/material/js/plugins/bootstrap-datetimepicker.min.js',
    // 'public/material/js/plugins/bootstrap-tagsinput.js',
    'resources/material/js/core.js',
    'resources/material/js/plugins/bootstrap-notify.js',
    'resources/material/js/material-dashboard.js',
    // 'public/material/js/settings.js',
    'node_modules/bootstrap-fileinput/js/fileinput.min.js',
    'node_modules/bootstrap-fileinput/themes/fas/theme.min.js',
    'resources/js/custom.js',
    'resources/js/charts.js',
    'resources/js/fileinput.js',
], 'public/js/app.js')
    .js('node_modules/jquery-touchswipe/jquery.touchSwipe.min.js','public/js')
    .js('resources/js/charts.js','public/js')
    .js('resources/js/enable-push.js','public/js')
    .copy('resources/material/js/core/jquery.min.js','public/js/')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/fontawesome.scss', 'public/css')
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts'
    )
    .copy('node_modules/moment/locale', 'public/locale/moment')
    .styles([
        // 'node_modules/perfect-scrollbar/css/perfect-scrollbar.css',
        'public/css/app.css',
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'resources/material/css/material-dashboard.css',
        'resources/material/css/css.css',
        'node_modules/bootstrap-select/dist/css/bootstrap-select.min.css',
        'resources/css/custom.css',
        'node_modules/bootstrap-fileinput/css/fileinput.min.css',
        'node_modules/@fullcalendar/common/main.css',
        // 'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        // 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'
    ], 'public/css/app.css')
    .styles([
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/bootstrap.min.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/pages-css/navbar.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/pages-css/footer.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/pages-css/how-it-works.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/aos.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/fontawesome.min.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/odometer.min.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/remixicon.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/magnific-popup.min.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/meanmenu.min.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/swiper-bundle.min.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/owl.carousel.min.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/owl.theme.default.min.css',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/style.css',
        'resources/css/guest.css',
    ],'public/css/guest.css')
    .styles([
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/css/pages-css/profile-authentication.css',
        'resources/css/auth.css',
    ],'public/css/auth.css')
    .js([
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/jquery.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/bootstrap.bundle.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/owl.carousel.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/swiper-bundle.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/magnific-popup.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/meanmenu.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/appear.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/odometer.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/form-validator.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/contact-form-script.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/ajaxchimp.min.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/aos.js',
        'resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/js/main.js',
    ],'public/js/guest.js')
    .copy('resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/img','public/assets/img/')
    .copy('resources/theme/pakap-app-saas-software-landing-page-html-template/pakap/assets/fonts','public/fonts/')
    .copy('resources/img','public/img/')
    .styles([
        'resources/css/mobile.css',
    ], 'public/css/mobile.css')
    .autoload({
        jquery: ['$', 'window.jQuery','Swiper'],
    })
mix.version();
// }


