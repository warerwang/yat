'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:RightsideCtrl
 * @description
 * # RightsideCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('RightsideCtrl', function ($scope, $location, $http, CategoryServ) {
        $scope.isActive = function(url){
            return url === $location.$$url;
        };
        CategoryServ.query(function(categories){
            $scope.categories = categories;
            $scope.setCategories(categories);
        });
  });
