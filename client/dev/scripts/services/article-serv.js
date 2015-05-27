'use strict';

/**
 * @ngdoc service
 * @name webappApp.ArticleServ
 * @description
 * # ArticleServ
 * Service in the webappApp.
 */
angular.module('webappApp')
  .factory('ArticleServ', function ($resource, API_BASE_URL, Session) {
        var access_token = Session.access_token;
        var article = $resource(API_BASE_URL + '/article/:aid?access-token=' + access_token, {aid:'@id'}, {
            query : {method:'GET', isArray:true, params:{cid:'@cid'}}
        });
        return article;
  });
