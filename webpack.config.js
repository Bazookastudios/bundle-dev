/**
 * Created by axelverdruye on 21/11/2017.
 */
// webpack.config.js
var Encore = require('@symfony/webpack-encore');
var FS = require("fs");
//Project stuff
const BOWER_ROOT = './vendor/bower/';
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

  // allow legacy applications to use $/jQuery as a global variable
  .autoProvidejQuery()

  .enableSourceMaps(!Encore.isProduction())

// create hashed filenames (e.g. app.abc123.css)
// .enableVersioning()
;

let addConfigs = function () {
  let filePath;
  let composerJson = require('./composer.json');
  composerJson = composerJson.require;

  let bazookasFolder = FS.readdirSync('./src/Bazookas/');
  for (let folder in bazookasFolder) {
    let fileName = null;
    let filePath = null;
    let gitModules = null;

    if (FS.existsSync('./.gitmodules')) {
      gitModules = FS.readFileSync('./.gitmodules', 'utf8');
    }

    if (composerJson[bazookasFolder[folder]]) {
      filePath = './vendor/' + bazookasFolder[folder] + '/webpack.config.js';
    }

    if (FS.existsSync('./src/Bazookas/' + bazookasFolder[folder] + '/encore.config.js')) {
      fileName = bazookasFolder[folder];
      filePath = './src/Bazookas/' + bazookasFolder[folder] + '/encore.config.js';

    } else if (FS.existsSync('./vendor/' + bazookasFolder[folder] + '/encore.config.js')) {
      fileName = bazookasFolder[folder];
      filePath = './vendor/' + bazookasFolder[folder] + '/encore.config.js';
    }

    if (filePath) {
      let moduleConfig = require(filePath);
      moduleConfig.mount(Encore);
      console.log('------------ ' + fileName + ' loaded ------------');
    }
  }
};

// export the final configuration
module.exports = function () {
  addConfigs();

  let config = Encore.getWebpackConfig();

  config.node = {
    fs: 'empty'
  };

  return config;
};
