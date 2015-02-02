'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:RightsideCtrl
 * @description
 * # RightsideCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('RightsideCtrl', function ($scope,$location,$http) {
        $scope.isActive = function(url){
            return url == $location.$$url;
        };
        $http.get('/rest/category').success(function(response){
            $scope.categorys = response.data;
        });
  });
