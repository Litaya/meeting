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
    mix.sass('app.scss')
       .webpack(['app.js','jquery-1.8.3.min.js'],'public/js/app.js')
        .scripts(['bootstrap-datetimepicker.js','bootstrap-datetimepicker.zh-CN.js','bootstrap.js'],'public/js/datetime.js');
});
