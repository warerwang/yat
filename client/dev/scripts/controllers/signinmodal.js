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
                        AuthService.loginByAccessToken(data.data.access_token)
                            .then(function(user){
                                $scope.setCurrentUser(user);
                            });
						$('#sign-in-modal').modal('hide');
					}else{
						$scope.userForm.password.$invalid = true;
						$scope.userForm.password.$dirty = true;
						$scope.userForm.password.error = data.message;
					}
				}, function () {
					console.log('error');
				});
		};
	});
