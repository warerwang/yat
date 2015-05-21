'use strict';

/**
 * @ngdoc service
 * @name webappApp.ArticleServ
 * @description
 * # ArticleServ
 * Service in the webappApp.
 */
angular.module('webappApp')
  .factory('ArticleServ', function ($resource) {
        var article = $resource('/rest/article/:aid', {aid:'@id'}, {
            query : {method:'GET', isArray:false}
        });
        return article;
  });
