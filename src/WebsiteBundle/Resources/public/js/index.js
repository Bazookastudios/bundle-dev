/**
 * SIMPLE JS MODULE SYSTEM
 **/

// then create the module itself
bazookas.main = (function() {
  // a module is basically a self executing function
  // returning an object with properties or methods
  var self = {};

  /**
   * Init function to do first setup or refresh parts of the page
   * @param DOM|jQuery the context in which to execute the init functions, this has no effect on the main module, but submodules should use this
   **/
  self.init = function(context) {
    // get all modules and execute the init functions
    callModuleFunctions('init', [context]);
  };

  // find elements in given context
  self.findInContext = function(selector, context) {
    if (context) {
      return $(context).find(selector);
    }
    else {
      return $(selector);
    }
  };
  function callModuleFunctions(functionName, parameters, includeMain) {
    if (!parameters) {
      parameters = [];
    }

    for (var moduleName in bazookas) {
      if (bazookas.hasOwnProperty(moduleName)) {
        // check if module is not main!!
        var module = bazookas[moduleName];
        if ((includeMain || module !== self) && typeof module[functionName] === 'function') {
          module[functionName].apply(module, parameters);
        }
      }
    }
  }

  // when document is ready execute init functions
  $(function() {
    self.init();
  });
  return self;
})();
