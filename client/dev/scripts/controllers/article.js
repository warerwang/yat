'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:ArticleCtrl
 * @description
 * # ArticleCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('ArticleCtrl', function ($scope, $http, $routeParams, $rootScope, Category) {
        $rootScope.breadcrumbs = [
            {href:'/', name:'首页'}
        ]
        $scope.getCategory = function(cid){
            return Category.getCategory(cid);
        }
        var id = $routeParams.id;
        $http.get('/rest/article/' + id)
            .success(function(response){
                $scope.article = response.data;
                $rootScope.breadcrumbs.push({href:'/category/' + $scope.article.cid, name:Category.getCategory($scope.article.cid).name});
                $rootScope.breadcrumbs.push({href:'#', name:$scope.article.title});
            });
  });
