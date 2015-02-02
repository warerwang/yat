'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('MainCtrl', function ($scope,$rootScope) {
    $rootScope.breadcrumbs = false;
    $scope.articles = [
        {id : 1, title : '标题', content: "内容"},
        {id : 1, title : '标题', content: "内容"},
        {id : 1, title : '标题', content: "内容"},
        {id : 1, title : '标题', content: "内容"}
    ];
  });
