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
  .controller('HeaderCtrl', function ($scope, $http, $location) {
        $scope.isActive = function(url){
            return url == $location.$$url;
        };
        $scope.isSign = true;
        $scope.showSignModal = function(){
            $('#signModal').modal('show');
        };
        $scope.showSignUpModal = function(){
            $scope.isSign = true;
        };
        $scope.signOut = function(){
            $scope.isSign = false;
        };
        $http.get('/rest/category').success(function(response){
            $scope.categorys = response.data;
        });

  });
