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
        var accessToken = Session.accessToken;
        var article = $resource(API_BASE_URL + '/article/:aid?access-token=:token', {aid:'@aid', token:'@token'}, {
            query : {method:'GET', isArray:true, params:{cid:'@cid',page:'@page'}},
            save : {method:'POST', url:API_BASE_URL + '/article?access-token=' + accessToken},
            update : {method:'PUT'}
        });
        article = Session.wrapActions( article );
        return article;
  });
