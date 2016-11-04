'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('MainCtrl', function ($scope,$rootScope, $http, ArticleServ, $location, $routeParams, UtilsService) {
    $rootScope.breadcrumbs = false;
    var page = $scope.page = $routeParams.page ? $routeParams.page * 1 : 1;

    ArticleServ.query({page:page},function(articles){
        $scope.articles = articles;

        $scope.articleCount = articles.length;
        $scope.itemCount = articles.length;
    });

    $scope.previousPage = function(){
        $location.path('/' + (--page));
    };

    $scope.nextPage = function(){
        $location.path('/' + (++page));
    };

    $scope.delete = function(index){
        UtilsService.confirm('确定要删除这篇文章么?', function(){
            var article = $scope.articles[index];
            article.$delete({aid:article.id}, function(){
                $scope.articles.splice(index, 1);
                $scope.showAlert('success', '删除文章成功.', 5000);
            });
        });
    };
    $scope.disableNextBtn = function() {
        return $scope.itemCount !== $scope.prePageCount;
    };
  });
