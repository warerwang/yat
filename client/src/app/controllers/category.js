'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:CategoryCtrl
 * @description
 * # CategoryCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('CategoryCtrl', function ($scope, $routeParams, $http, $rootScope, ArticleServ, $location, UtilsService) {
        $rootScope.breadcrumbs = [
            {href:'/', name:'首页'}
        ];
        var cid = $routeParams.id,
            page = $scope.page = $routeParams.page ? $routeParams.page * 1 : 1;

        ArticleServ.query({cid:cid, page:page}, function(articles){
            $scope.articles = articles;
            $rootScope.breadcrumbs.push({href: '#', name: $scope.getCategory(cid).name});

            $scope.itemCount = articles.length;
        });

        $scope.previousPage = function () {
            $location.path('/category/' + cid + '/' + (--page));
        };

        $scope.nextPage = function () {
            $location.path('/category/' + cid + '/' + (++page));
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
