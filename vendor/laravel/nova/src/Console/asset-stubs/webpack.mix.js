let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/asset.js', 'js')
  .vue({ version: 2 })
  .sass('resources/sass/asset.scss', 'css')
  .webpackConfig({
    externals: {
      Vue: 'vue',
    },
  })
