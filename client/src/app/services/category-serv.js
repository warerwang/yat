'use strict';

/**
 * @ngdoc service
 * @name webappApp.categoryServ
 * @description
 * # categoryServ
 * Factory in the webappApp.
 */
angular.module('webappApp')
  .factory('CategoryServ', function ($resource, API_BASE_URL, Session) {
    var category = $resource(API_BASE_URL + '/category/:cid?access-token=' + Session.accessToken, {cid:'@cid'}, {
        query : {method:'GET', isArray:true}
    });
    return category;
  });
