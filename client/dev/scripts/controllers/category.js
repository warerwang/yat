'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:CategoryCtrl
 * @description
 * # CategoryCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('CategoryCtrl', function ($scope, $routeParams, $http, $rootScope, ArticleServ) {
        $rootScope.breadcrumbs = [
            {href:'/', name:'首页'}
        ];
        var cid = $routeParams.id;
        ArticleServ.query({cid:cid}, function(articles){
            $scope.articles = articles;
        });
  });
