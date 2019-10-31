const Encore = require('./bundles/Bazookas/CommonBundle/common.config');

const WEBSITE_ROOT = './src/WebsiteBundle/Resources/public/';
const DEMO_ROOT = './src/DemoBundle/Resources/public/';

// Encore
//   .addEntry('js/app', WEBSITE_ROOT + 'js/main.js').
//   addEntry('js/custom_admin_components',
//     DEMO_ROOT + 'js/admin/CustomAdminComponents.js')
//   .addStyleEntry('css/app', WEBSITE_ROOT + 'css/main.scss');

module.exports = function () {
  let config = Encore.getWebpackConfig();

  //This is needed for mysterious reasons
  config.node = {
    fs: 'empty',
  };

  return config;
};
