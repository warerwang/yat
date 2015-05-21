'use strict';

describe('Service: ArticleServ', function () {

  // load the service's module
  beforeEach(module('yatApp'));

  // instantiate service
  var ArticleServ;
  beforeEach(inject(function (_ArticleServ_) {
    ArticleServ = _ArticleServ_;
  }));

  it('should do something', function () {
    expect(!!ArticleServ).toBe(true);
  });

});
