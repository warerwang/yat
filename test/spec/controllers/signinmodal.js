'use strict';

describe('Controller: SigninmodalCtrl', function () {

  // load the controller's module
  beforeEach(module('webappApp'));

  var SigninmodalCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    SigninmodalCtrl = $controller('SigninmodalCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
