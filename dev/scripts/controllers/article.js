'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:ArticleCtrl
 * @description
 * # ArticleCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('ArticleCtrl', function ($scope, $http, $routeParams) {
        var id = $routeParams.id;
        $http.get('/article/' + id)
            .success(function(response){
                $scope.article = response.data;
            })
  });
