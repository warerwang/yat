'use strict';

/**
 * @ngdoc function
 * @name webappApp.controller:SigninmodalCtrl
 * @description
 * # SigninmodalCtrl
 * Controller of the webappApp
 */
angular.module('webappApp').controller('SigninmodalCtrl', function ($scope, $http, $cookieStore) {

        $scope.submit = function (isValid) {
            $http.get('/rest/user/access-token?email=' + $scope.email + '&password=' + $scope.password).success(function (response) {
                    $cookieStore.put("access_token", response.data.access_token);
                    $('#signModal').modal('hide');
                }).error(function (response) {
                    $scope.userForm.password.$invalid = true;
                    $scope.userForm.password.error = response.message;
                });
        };
    });
