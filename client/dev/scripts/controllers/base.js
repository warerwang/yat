'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:BaseCtrl
 * @description
 * # BaseCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('BaseCtrl', function ($scope, AuthService, Session, ArticleServ) {
        
        $scope.currentUser = null;
        $scope.isAuthorized = AuthService.isAuthenticated();

        if($scope.isAuthorized){
            AuthService.loginByAccessToken(Session.access_token)
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
            return $location.$$url == url;
        };

        $scope.showSignModal = function(){
            $('#sign-in-modal').modal('show');
            return false;
        };
        $scope.showSignUpModal = function(){
            $('#sign-up-modal').modal('show');
            return false;
        };
  });
