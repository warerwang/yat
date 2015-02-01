'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:ArticleCtrl
 * @description
 * # ArticleCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('ArticleCtrl', function ($scope, $http, $routeParams, $rootScope) {
        $rootScope.breadcrumbs = [
            {href:'/', name:'首页'}
        ]
        var id = $routeParams.id;
        $http.get('/rest/article/' + id)
            .success(function(response){
                $scope.article = response.data;
                $rootScope.breadcrumbs.push({href:'/category/' + $scope.article.cid, name:"分类"});
                $rootScope.breadcrumbs.push({href:'#', name:$scope.article.title});
            });
  });
