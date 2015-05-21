'use strict';
/*global $:false */
/**
 * @ngdoc function
 * @name webappApp.controller:HeaderCtrl
 * @description
 * # HeaderCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('HeaderCtrl', function ($scope, $http, $rootScope, $location, Session) {
        $scope.showSignModal = function(){
            $('#signModal').modal('show');
        };
        $scope.showSignUpModal = function(){
	        
        };
  });
