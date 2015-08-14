'use strict';
/* global $ */
/**
 * @ngdoc function
 * @name webappApp.controller:BaseCtrl
 * @description
 * # BaseCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('BaseCtrl', function ($scope, AuthService, Session, $location, PRE_PAGE_COUNT, $timeout, UtilsService, $route) {
        $scope.prePageCount = PRE_PAGE_COUNT;
        $scope.currentUser = null;
        $scope.isAuthorized = AuthService.isAuthenticated();
		$scope.absUrl = $location.absUrl();
        $scope.alert = {
            isShow : false,
            type   : '',
            message: ''
        };
        $scope.showAlert = function(type, message, time){
            $scope.alert = {
                isShow : true,
                type   : type,
                message: message
            };
            if(time > 0){
                $timeout(
                    function() {
                        $scope.alert.isShow = false;
                    },
                    time
                );
            }
        };
        if($scope.isAuthorized){
            AuthService.loginByAccessToken(Session.accessToken)
                .then(function (user) {
                    $scope.setCurrentUser(user);
                });
        }

        $scope.setCurrentUser = function (user) {
            $scope.currentUser = user;
            $scope.isAuthorized = AuthService.isAuthenticated();
        };

        $scope.signOut = function(){
            Session.destroy();
            $scope.isAuthorized = AuthService.isAuthenticated();
        };

        $scope.isActive = function (url){
            return $location.$$url === url;
        };

        $scope.showSignModal = function(){
            $('#sign-in-modal').modal('show');
            return false;
        };
        $scope.showSignUpModal = function(){
            $('#sign-up-modal').modal('show');
            return false;
        };

        $scope.setCategories = function(categories){
            $scope.categories = categories;
        };

        $scope.getCategory = function (cid) {
            var category;
            for (var i in $scope.categories) {
                if ($scope.categories[i].id === cid) {
                    category = $scope.categories[i];
                    break;
                }
            }
            return category;
        };

        $scope.search = function(){
            UtilsService.rebound('search-key-down', function(){
                $location.path('/search/' + $scope.keyword);
                $route.reload();
            }, 1000);
        };
  });
