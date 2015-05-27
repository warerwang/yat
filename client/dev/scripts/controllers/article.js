'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:ArticleCtrl
 * @description
 * # ArticleCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('ArticleCtrl', function ($scope, $http, $routeParams, $rootScope, CategoryServ, ArticleServ) {
        $rootScope.breadcrumbs = [
            {href:'/', name:'首页'}
        ]
        var id = $routeParams.id;
        ArticleServ.get({aid:id}, function(article) {
            $scope.article = article;
            $rootScope.breadcrumbs.push({href:'/category/' + article.cid, name:$scope.getCategory(article.cid).name});
            $rootScope.breadcrumbs.push({href:'#', name:article.title});
        });
  });
