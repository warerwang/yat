'use strict';

describe('Controller: ArticlePostCtrl', function () {

  // load the controller's module
  beforeEach(module('webappApp'));

  var ArticlePostCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    ArticlePostCtrl = $controller('ArticlePostCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
