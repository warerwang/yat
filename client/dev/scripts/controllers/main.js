'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('MainCtrl', function ($scope,$rootScope, $http, Category) {
    $rootScope.breadcrumbs = false;
    $scope.getCategory = function(cid){
        return Category.getCategory(cid);
    }
    $http.get('/rest/article/index')
        .success(function(response){
            $scope.articles = response.data;
        });
  });
