'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:CategoryCtrl
 * @description
 * # CategoryCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('CategoryCtrl', function ($scope, $routeParams, $http) {
        var cid = $routeParams.id;
        $http
            .get('/category/' + cid + '/list')
            .success(function(response){
                $scope.articles = response.data;
            })
  });
