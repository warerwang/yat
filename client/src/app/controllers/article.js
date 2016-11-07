'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:ArticleCtrl
 * @description
 * # ArticleCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('ArticleCtrl', function ($scope, $http, $routeParams, $rootScope, CategoryServ, ArticleServ, $sce, UtilsService, $location) {
    function setBreadcrumbs(article){
      $rootScope.breadcrumbs = [
        {href:'/', name:'首页'}
      ];
      $rootScope.breadcrumbs.push({href:'/category/' + article.cid, name:$scope.getCategory(article.cid).name});
      $rootScope.breadcrumbs.push({href:'#', name:article.title});
    }
    var id = $routeParams.id;
    ArticleServ.get({aid:id}, function(article) {
        setBreadcrumbs(article);
        article.trustContent = $sce.trustAsHtml(article.content);
        $scope.article = article;
      $scope.$broadcast('dataloaded');
    });

    $scope.isEditMode = false;
    $scope.edit = function(){
        $scope.isEditMode = true;
        $scope.chooseCategory = $scope.getCategory($scope.article.cid);
    };

    $scope.delete = function(){
        UtilsService.confirm('确定要删除这篇文章么?', function(){
            $scope.article.$delete({aid:id}, function(){
                $location.path('/');
            });
        });

    };

    $scope.submitEdit = function(){
        $scope.isEditMode = false;
        $scope.article.cid = $scope.chooseCategory.id;
        $scope.article.$update({aid:id},function(article){
            setBreadcrumbs(article);
            $scope.article.trustContent = $sce.trustAsHtml(article.content);
            $scope.$broadcast('dataloaded');
        });
    };
  });
