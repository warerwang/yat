'use strict';
/**
 * Created by yadongw on 15-5-6.
 */

angular.module('webappApp')

    .factory('AuthService', function ($http, Session, API_BASE_URL) {
        var authService = {};

        authService.login = function (email, password) {
            return $http.get(API_BASE_URL + '/user/access-token?email=' + email + '&password=' + password);
        };

        authService.signUp = function (email, password) {
            return $http.post(API_BASE_URL + '/user', {email: email, password: password});
        };

        authService.loginByAccessToken = function (accessToken) {
            return $http.get(API_BASE_URL + '/user/current?access-token=' + accessToken).then(function (res) {
                    return res.data;
                });
        };

        authService.isAuthenticated = function () {
            return !!Session.accessToken;
        };

        authService.saveAccessToken = function (accessToken){
            Session.create(accessToken);
        };

        return authService;
    });