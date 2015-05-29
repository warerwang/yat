'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:ArticleCtrl
 * @description
 * # ArticleCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('ArticleCtrl', function ($scope, $http, $routeParams, $rootScope, CategoryServ, ArticleServ, $sce) {
        $rootScope.breadcrumbs = [
            {href:'/', name:'首页'}
        ];
        var id = $routeParams.id;
        ArticleServ.get({aid:id}, function(article) {
            $scope.article = article;
	        $scope.article.content = $sce.trustAsHtml($scope.article.content);
            $rootScope.breadcrumbs.push({href:'/category/' + article.cid, name:$scope.getCategory(article.cid).name});
            $rootScope.breadcrumbs.push({href:'#', name:article.title});
	        $scope.$broadcast('dataloaded');
        });
  });
