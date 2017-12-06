// webpack.config.js
let Encore = require('@symfony/webpack-encore');
let FS = require("fs");

//Project stuff
let addedConfigs = {};
const WEBSITE_ROOT = './src/WebsiteBundle/Resources/public/';

Encore
  // directory where all compiled assets will be stored
  .setOutputPath('web/build/')

  // what's the public path to this directory (relative to your project's document root dir)
  .setPublicPath('/build')

  // empty the outputPath dir before each build
  .cleanupOutputBeforeBuild()

  // will output as web/build/app.js
  .addEntry('app', WEBSITE_ROOT + 'js/main.js')

  // will output as web/build/global.css
  .addStyleEntry('global', WEBSITE_ROOT + 'css/main.scss')

  // allow sass/scss files to be processed
  .enableSassLoader(function(sassOptions) {},{
    resolveUrlLoader: false
  })

  .enableSourceMaps(!Encore.isProduction())

  // you can use this method to provide other common global variables,
  // such as '_' for the 'underscore' library. IMPORTANT: these variables are only available
  // to javascript files processed by webpack. Files which require some of these as global variables should use
  // the globals.js file instead (for admin bundle files).
  .autoProvideVariables({
    $: 'jquery',
    jQuery: 'jquery',
    'window.jQuery': 'jquery',
    'moment': 'moment'
  })
;

function addBundleConfigs() {
  // vendor folder takes precedence, as is custom with composer dependencies
  findConfigs('./vendor/bazookas/');
  findConfigs('./src/Bazookas/');
}

function findConfigs(bazookasFolder) {
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
