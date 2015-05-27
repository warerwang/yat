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
				.then(function (res) {
                    AuthService.saveAccessToken(res.data.access_token);
                    AuthService.loginByAccessToken(res.data.access_token)
                        .then(function(user){
                            console.log(user);
                            $scope.setCurrentUser(user);
                        });
                    $('#sign-in-modal').modal('hide');
				}, function (res) {
                    $scope.userForm.password.$invalid = true;
                    $scope.userForm.password.$dirty = true;
                    $scope.userForm.password.error = res.data.message;
				});
		};
	});
