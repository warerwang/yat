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
        window.alert($scope.email + '|' + $scope.password + '|' +$scope.rememberMe);

    };
  });
