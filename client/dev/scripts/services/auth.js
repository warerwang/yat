/**
 * Created by yadongw on 15-5-6.
 */

angular.module('webappApp')
.factory('AuthService', function ($http, Session) {
	var authService = {};

	authService.login = function (email, password) {

		return $http.get('/rest/user/access-token?email=' + email + '&password=' + password)
			.then(function (res) {
				Session.create(res.data.data.id, res.data.data.nickname, res.data.data.access_token);
				return res.data;
			},function(res){
				return res.data;
			});
	};

	authService.loginByAccessToken = function (access_token) {
		return $http.get('/rest/user/-/current?access-token=' + access_token)
			.then(function (res) {
				return res.data.data;
			});
	};

	authService.isAuthenticated = function () {
		return !!Session.access_token;
	};


	return authService;
});