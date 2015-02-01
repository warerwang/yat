'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:CategoryCtrl
 * @description
 * # CategoryCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('CategoryCtrl', function ($scope, $routeParams, $http, $rootScope) {
        $rootScope.breadcrumbs = [
            {href:'/', name:'首页'}
        ];
        var cid = $routeParams.id;
        $http
            .get('/rest/category/' + cid + '/list')
            .success(function(response){
                $scope.articles = response.data;
                $rootScope.breadcrumbs.push({href:'/category/' + cid, name:'分类'});
            });
  });
