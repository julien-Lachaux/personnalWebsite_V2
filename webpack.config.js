var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */

    //
    // ─────────────────────────────────────────────────────────── LES VENDORS ────────
    //
    .addEntry('vendor/jscolor-2.0.5/jscolor', './assets/vendor/jscolor-2.0.5/jscolor.js')

    //
    // ─────────────────────────────────────────────────────────── LES SCRIPTS JS ─────
    //
    // standard site
    .addEntry('js/init', './assets/js/init.js')
    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/utils', './assets/js/utils.js')
    .addEntry('js/components/navs', './assets/js/components/navs.js')
    .addEntry('js/components/cards', './assets/js/components/cards.js')
    .addEntry('js/components/panels', './assets/js/components/panels.js')
    .addEntry('js/components/animations', './assets/js/components/animations.js')

    // admin
    .addEntry('js/admin/pages/skills', './assets/js/admin/pages/skills.js')

    //
    // ──────────────────────────────────────────────────────── LES FICHIERS SASS ─────
    //
    .addEntry('css/app', './assets/css/app.scss')

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    .enablePostCssLoader((options) => {
        options.config = {
            path: 'config/postcss.config.js'
        };
    })

    // uncomment if you're having problems with a jQuery plugin
     .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
