// webpack.config.js
let Encore = require('@symfony/webpack-encore');
let FS = require("fs");

//Project stuff
let addedConfigs = {};
const WEBSITE_ROOT = './src/WebsiteBundle/Resources/public/';

Encore
  // directory where all compiled assets will be stored
  .setOutputPath('web/static/')
  .enableVersioning(Encore.isProduction())

  // what's the public path to this directory (relative to your project's document root dir)
  .setPublicPath('/static')

  // empty the outputPath dir before each build
  .cleanupOutputBeforeBuild()

  // will output as web/build/app.js
  .addEntry('js/app', WEBSITE_ROOT + 'js/main.js')

  // will output as web/build/global.css
  .addStyleEntry('css/app', WEBSITE_ROOT + 'css/main.scss')

  // allow sass/scss files to be processed
  .enableSassLoader(function(sassOptions) {},{
    resolveUrlLoader: false
  })

  //Enable source maps in dev environment
  .enableSourceMaps(!Encore.isProduction())

  //Add an image pre-processor to optimize images (optimization will only occur in production)
  .disableImagesLoader()
  .addLoader({
    test: /\.(gif|png|jpe?g|svg)$/i,
    use: [
      {
        loader: 'file-loader',
        options: {
          name(file) {
            // put images in a different folder to prevent name collisions
            let path = 'images/';
            if (/(\/vendor\/bazookas\/)|(\/src\/Bazookas\/)/.test(file)) {
              path += 'bundles/';
            }
            else if (/node_modules/.test(file)) {
              path += 'node_modules/';
            }

            return path + '[name].[ext]';
          }
        }
      },
      {
        loader: 'image-webpack-loader',
        options: {
          mozjpeg: {
            progressive: true,
            quality: 85
          },
          // optipng.enabled: false will disable optipng
          optipng: {
            enabled: true,
          },
          pngquant: {
            quality: '65-90',
            speed: 4
          },
          gifsicle: {
            interlaced: false,
          },
          // the webp option will enable WEBP
          webp: {
            quality: 85
          }
        }
      },
    ],
  })

  .enableVueLoader(function(options) {
    options.loaders = {
      // Since sass-loader (weirdly) has SCSS as its default parse mode, we map
      // the "scss" and "sass" values for the lang attribute to the right configs here.
      // other preprocessors should work out of the box, no loader config like this nessessary.
      'scss': 'vue-style-loader!css-loader!sass-loader',
      'sass': 'vue-style-loader!css-loader!sass-loader?indentedSyntax'
    };
    options.preserveWhitespace = false;
  })

  // you can use this method to provide other common global variables,
  // such as '_' for the 'underscore' library. IMPORTANT: these variables are only available
  // to javascript files processed by webpack. Files which require some of these as global variables should use
  // the BazookasAdminBundle/Resources/public/js/globals.js file instead (for admin bundle files).
  .autoProvideVariables({
    $: 'jquery',
    jQuery: 'jquery',
    'window.jQuery': 'jquery',
    'moment': 'moment',
    'bootbox': 'bootbox'
  })
;

//Indicate to Vue that we are running in production mode
if (Encore.isProduction()) {
  Encore.addPlugin(new Webpack.DefinePlugin({
    'process.env': {
      NODE_ENV: '"production"'
    }
  }));

  //Prevent momentjs from loading ALL of the available locales
  Encore.addPlugin(new Webpack.ContextReplacementPlugin(/moment[\/\\]locale$/, /en|nl/));

  Encore.addPlugin(new Webpack.optimize.UglifyJsPlugin());
  Encore.addPlugin(new Webpack.optimize.OccurrenceOrderPlugin());

  //Post-process chunks to reduce code duplication
  Encore.addPlugin(new Webpack.optimize.LimitChunkCountPlugin({maxChunks: 15}));

  //Create only chunks of 25kb or larger
  Encore.addPlugin(new Webpack.optimize.MinChunkSizePlugin({minChunkSize: 25000}));

  //Enable this to view an analysis of the js files generated.
  // var BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
  // Encore.addPlugin(new BundleAnalyzerPlugin());
}

function addBundleConfigs() {
  // vendor folder takes precedence, as is custom with composer dependencies
  findConfigs('./vendor/bazookas/');
  findConfigs('./src/Bazookas/');
}

function findConfigs(bazookasFolder) {
  if (!FS.existsSync(bazookasFolder)) {
    return;
  }

  let folders = FS.readdirSync(bazookasFolder);

  for (let folder of folders) {
    folder = bazookasFolder + folder;

    addConfig(folder + '/composer.json', folder + '/encore.config.js');
  }
}

function addConfig(composer, config) {
  if (
    FS.existsSync(composer)
    &&
    FS.existsSync(config)
  ) {

    // only add the config if it was not added before
    // use the composer package name to check for duplicates
    let composerJson = require(composer);
    if (addedConfigs.hasOwnProperty(composerJson.name) === false) {
      console.info(composerJson.name+':', 'adding ' + config);
      require(config).mount(Encore);
      addedConfigs[composerJson.name] = config;
    }
    else {
      console.warn(composerJson.name+':', 'already added ' + config + ' from ' + addedConfigs[composerJson.name]);
    }
  }
}

// export the final configuration
module.exports = function () {
  addBundleConfigs();

  let config = Encore.getWebpackConfig();

  config.node = {
    fs: 'empty'
  };

  return config;
};
