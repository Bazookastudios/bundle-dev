const TASKS = require('gulpinator/utilities/taskNames');
const FS = require('fs');

//submodule name => composer keys for modules
const BAZOOKAS_MODULES = {
  //Not applicable
  // 'GeneratorBundle': 'bazookas/generator-bundle',

  'AdminBundle': 'bazookas/admin-bundle',
  'CommonBundle': 'bazookas/common-bundle',
  'APIFrameworkBundle': 'bazookas/api-framework-bundle',
  'CronBundle': 'bazookas/cron-bundle',
  'SecurityBundle': 'bazookas/security-bundle',
  'MediaBundle': 'bazookas/media-bundle',
  'IntegrationsBundle': 'bazookas/integrations-bundle'
};

//Project stuff
const BOWER_ROOT = './vendor/bower/';
const WEBSITE_ROOT = './src/WebsiteBundle/Resources/public/';

let config = {
  files: [

    //TODO add your own tasks here, sample tasks provided below

    // Moving images
    {
      task: TASKS.move,
      target: [
        WEBSITE_ROOT + 'images/**'
      ],
      options: {
        dest: 'img'
      }
    },
    // compile scss
    {
      task: TASKS.styles,
      target: WEBSITE_ROOT + 'css/**/*.scss',
      options: {
        dest: 'styles',
        sourcemaps: true
      }
    },
    // move additional files
    // (fonts, etc.)
    {
      task: TASKS.move,
      target: [
        WEBSITE_ROOT + 'other/**'
      ]
    },
    // Bundle bower javascript libraries
    {
      task: TASKS.jsBundle,
      target: [
      ],
      options: {
        name: 'web-libs',
        dest: 'scripts'
      }
    },

    // custom scripts
    {
      task: TASKS.jsBundle,
      target: [
        WEBSITE_ROOT + 'js/**/*.js'
      ],
      options: {
        name: 'scripts',
        dest: 'scripts',
        minify: true
      }
    }

  ],
  options: {
    dest: 'web'
  }
};

let mergeConfigs = function () {
  let composerJson = require('./composer.json');
  composerJson = composerJson.require;

  let gitModules = null;
  if (FS.existsSync('./.gitmodules')) {
    gitModules = FS.readFileSync('./.gitmodules', 'utf8');
  }

  let moduleConfig;
  let filePath;
  for(let gitName in BAZOOKAS_MODULES) {
    moduleConfig = [];
    filePath = null;

    //check if its a submodule
    if (gitModules && gitModules.indexOf(gitName) > 0) {
      filePath = './src/Bazookas/' + gitName + '/gulpinator.config.js';
      //check if its a vendor module
    } else if (composerJson[BAZOOKAS_MODULES[gitName]]) {
      filePath = './vendor/' + BAZOOKAS_MODULES[gitName] + '/gulpinator.config.js';
    }

    //check if a configurator is defined
    if (filePath && FS.existsSync(filePath)) {
      moduleConfig  = require(filePath);
      moduleConfig = moduleConfig.default.files;

      for (let task in moduleConfig) {
        config.files.push(moduleConfig[task]);
      }
    }
  }

  return config;
};

module.exports = {
  default: mergeConfigs()
};
