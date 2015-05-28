'use strict';

/**
 * @ngdoc overview
 * @name webappApp
 * @description
 * # webappApp
 *
 * Main module of the application.
 */
angular
  .module('webappApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngTouch',
    'summernote'
  ])
  .config(function ($routeProvider, $locationProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
        .when('/category/:id', {
            templateUrl: 'views/main.html',
            controller: 'CategoryCtrl'
        })
        .when('/article/post', {
            templateUrl: 'views/article-post.html',
            controller: 'ArticlePostCtrl'
        })
        .when('/article/:id', {
            templateUrl: 'views/article.html',
            controller: 'ArticleCtrl'
        })
      .otherwise({
        redirectTo: '/'
      });
    $locationProvider.html5Mode(true);
  })
	.constant('AUTH_EVENTS', {
		loginSuccess: 'auth-login-success',
		loginFailed: 'auth-login-failed',
		logoutSuccess: 'auth-logout-success',
		sessionTimeout: 'auth-session-timeout',
		notAuthenticated: 'auth-not-authenticated',
		notAuthorized: 'auth-not-authorized'
	})
    .constant('API_BASE_URL', 'http://api.yat.com');
