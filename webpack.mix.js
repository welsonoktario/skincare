const mix = require("laravel-mix");
require('laravel-mix-purgecss');

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

mix
  .js(
    [
      "resources/js/app.js",
      "resources/js/scripts.js",
      "resources/js/stisla.js",
      "resources/js/custom.js",
    ],
    "public/js"
  )
  .extract()
  .sass("resources/css/app.scss", "public/css")
  .css("resources/css/style.css", "public/css")
  .css("resources/css/components.css", "public/css")
  .css("resources/css/custom.css", "public/css")
  .copyDirectory("resources/img", "public/img")
  .purgeCss()
  .disableNotifications();

mix.options({
  postCss: [require("postcss-custom-properties")],
});
