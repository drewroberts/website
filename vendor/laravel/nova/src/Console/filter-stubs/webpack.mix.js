let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/filter.js', 'js')
  .vue({ version: 2 })
  .sass('resources/sass/filter.scss', 'css')
  .webpackConfig({
    externals: {
      Vue: 'vue',
    },
  })
