const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix){
    mix.sass(['app.scss'],'public/css/app.css')
        .webpack(['app.js'],'public/js/app.js')
        .scripts(['bootstrap-datetimepicker.js','bootstrap-datetimepicker.zh-CN.js'],'public/js/jquery-plugin.js');
});
