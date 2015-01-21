'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:SigninmodalCtrl
 * @description
 * # SigninmodalCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('SigninmodalCtrl', function ($scope) {
    $scope.submit = function(){
        alert($scope.email + '|' + $scope.password + '|' +$scope.remember_me);

    }
  });
