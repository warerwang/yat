'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('MainCtrl', function ($scope,$rootScope, $http, Category, ArticleServ) {
    $rootScope.breadcrumbs = false;
    $scope.getCategory = function(cid){
        return Category.getCategory(cid);
    };
    $scope.articles = ArticleServ.query(function(response){
        $scope.articles = response.data;
    });
  });
