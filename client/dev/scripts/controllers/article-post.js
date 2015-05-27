'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:ArticlePostCtrl
 * @description
 * # ArticlePostCtrl
 * Controller of the webappApp
 */
angular.module('webappApp').controller('ArticlePostCtrl', function ($scope, CategoryServ, ArticleServ, $location) {
        $scope.article = new ArticleServ;
        $scope.post = function(){
            $scope.article.$save(function(response){
                $location.path('/article/' + response.data.id);
            });
        }
    });
