const gulp = require('gulp');
const gulpinator = require('gulpinator');
const FS = require('fs');
const _ = require('lodash');
const spawn = require('child_process').spawn;

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

gulpinator.initializeSubTasks(gulp);

/**
 * An extra task to loop through all the installed bazookas re-usable components and to merge their bower.json
 * with the project's bower.jsons
 */
gulp.task('bower-install', function() {
  //Merge the bower.json files
  let bowerJson = require('./bower.json');

  let composerJson = require('./composer.json');
  composerJson = composerJson.require;

  let gitModules = null;
  if (FS.existsSync('./.gitmodules')) {
    gitModules = FS.readFileSync('./.gitmodules', 'utf8');
  }

  let moduleBower;
  let filePath;
  for(let gitName in BAZOOKAS_MODULES) {
    moduleBower = [];
    filePath = null;

    //check if its a submodule
    if (gitModules && gitModules.indexOf(gitName) > 0) {
      filePath = './src/Bazookas/' + gitName + '/bower.json';
      //check if its a vendor module
    } else if (composerJson[BAZOOKAS_MODULES[gitName]]) {
      filePath = './vendor/' + BAZOOKAS_MODULES[gitName] + '/bower.json';
    }

    //check if a configurator is defined
    if (filePath && FS.existsSync(filePath)) {
      moduleBower  = require(filePath);
      _.merge(bowerJson.dependencies, moduleBower.dependencies);
    }
  }

  FS.writeFileSync('./bower.json', JSON.stringify(bowerJson));

  //execute bower update
  let bowerCommand = spawn('bower update', [], {shell: true, stdio: 'inherit'});
  bowerCommand.on('close', function(code){
    if (code > 0) {
      console.log('child process exited with code ' + code.toString());
    }
  });

  bowerCommand.on('error', function(error){
    console.log('child process exited due to error ' + error.toString());
  });
});

gulpinator.initializeMainTasks(gulp);
