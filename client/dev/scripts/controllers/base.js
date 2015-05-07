'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:BaseCtrl
 * @description
 * # BaseCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
  .controller('BaseCtrl', function ($scope, AuthService, Session) {

	$scope.currentUser = null;
	$scope.isAuthorized = AuthService.isAuthenticated();
	if($scope.isAuthorized){
		$scope.currentUser = null;
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
  });
