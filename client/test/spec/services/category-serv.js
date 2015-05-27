'use strict';

describe('Service: categoryServ', function () {

  // load the service's module
  beforeEach(module('webappApp'));

  // instantiate service
  var categoryServ;
  beforeEach(inject(function (_categoryServ_) {
    categoryServ = _categoryServ_;
  }));

  it('should do something', function () {
    expect(!!categoryServ).toBe(true);
  });

});
