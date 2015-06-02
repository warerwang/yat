'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('MainCtrl', function ($scope,$rootScope, $http, ArticleServ) {
    $rootScope.breadcrumbs = false;
    ArticleServ.query(function(articles){
        $scope.articles = articles;
    });
  });
