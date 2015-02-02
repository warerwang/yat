'use strict';

describe('Controller: RightsideCtrl', function () {

  // load the controller's module
  beforeEach(module('webappApp'));

  var RightsideCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    RightsideCtrl = $controller('RightsideCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
