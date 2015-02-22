'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:CategoryCtrl
 * @description
 * # CategoryCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('CategoryCtrl', function ($scope, $routeParams, $http, $rootScope, Category) {
        $rootScope.breadcrumbs = [
            {href:'/', name:'首页'}
        ];
        $scope.getCategory = function(cid){
            return Category.getCategory(cid);
        };
        var cid = $routeParams.id;

        $http.get('/rest/category/' + cid + '/articles')
             .success(function(response){
                $rootScope.breadcrumbs.push({href:'/category/' + cid, name:$scope.getCategory(cid).name});
                $scope.articles = response.data;
         });
  });
