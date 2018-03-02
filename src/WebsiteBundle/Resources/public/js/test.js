bazookas.test = (function () {
  var self = {};

  self.init = function (context) {
    self.testFunction();
  };

  self.testFunction = function () {
    $('#content').html('<h1 id="title">THIS IS CREATED WITH JS MODULE</h1>');
    $('#title').addClass('red');
  };

  return self;
})();
