'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:SigninmodalCtrl
 * @description
 * # SigninmodalCtrl
 * Controller of the webappApp
 */
angular.module('webappApp')
	.controller('SigninmodalCtrl', function ($scope, $http, AuthService) {
		$scope.submit = function () {
			AuthService.login($scope.email, $scope.password)
				.then(function (data) {
					if(data.ret == 0){
						$scope.setCurrentUser(data.data);
						$('#signModal').modal('hide');
					}else{
						$scope.userForm.password.$invalid = true;
						$scope.userForm.password.$dirty = true;
						$scope.userForm.password.error = data.message;
					}
//  				$rootScope.$broadcast(AUTH_EVENTS.loginSuccess);
				}, function () {
					console.log('error');
//					$rootScope.$broadcast(AUTH_EVENTS.loginFailed);
				});
		};
	});
