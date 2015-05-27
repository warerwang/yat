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
            return $http.post(API_BASE_URL + '/user', {email: email, password: password})
                .then(function (res) {
                    Session.create(res.data.access_token);
                    return res;
                }, function (res) {
                console.log(res);
                    return res;
                });
        };

        authService.loginByAccessToken = function (access_token) {
            return $http.get(API_BASE_URL + '/user/current?access-token=' + access_token).then(function (res) {
                    return res.data;
                });
        };

        authService.isAuthenticated = function () {
            return !!Session.access_token;
        };

        authService.saveAccessToken = function (access_token){
            Session.create(access_token);
        }

        return authService;
    });