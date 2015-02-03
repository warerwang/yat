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
        var cid = $routeParams.id;
        $rootScope.breadcrumbs.push({href:'/category/' + cid, name:Category.getCategory(cid).name});
        $http.get('/rest/category/' + cid + '/list')
             .success(function(response){
                $scope.articles = response.data;

             });
  });
