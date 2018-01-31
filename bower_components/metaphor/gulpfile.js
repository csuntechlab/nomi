'use strict';

var elixir = require('laravel-elixir');
var bowerPath = './bower_components';

elixir(function(mix) {
  mix.copy(`${bowerPath}/jquery/dist/jquery.min.js`, 'src/js/vendor/jquery.js');
  mix.copy(`${bowerPath}/jquery-ui/ui/widgets/datepicker.js`, 'src/js/vendor/datepicker.js');
  mix.copy(`${bowerPath}/font-awesome/scss`, 'src/sass/vendor/font-awesome');
  mix.copy(`${bowerPath}/font-awesome/fonts`, 'dist/fonts');

  mix.scripts([
    'vendor/jquery.js',
    'vendor/datepicker.js',
    'components/accordion.js',
    'scripts.js',
  ],'dist/js/metaphor.js', 'src/js');

  mix.sass('metaphor.scss', 'dist/css', 'src/sass');
});
