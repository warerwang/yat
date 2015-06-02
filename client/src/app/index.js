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
                templateUrl: 'app/views/main.html',
                controller: 'MainCtrl'
            })
            .when('/category/:id', {
                templateUrl: 'app/views/main.html',
                controller: 'CategoryCtrl'
            })
            .when('/article/post', {
                templateUrl: 'app/views/article-post.html',
                controller: 'ArticlePostCtrl'
            })
            .when('/article/:id', {
                templateUrl: 'app/views/article.html',
                controller: 'ArticleCtrl'
            })
            .otherwise({
                redirectTo: '/'
            });
        $locationProvider.html5Mode(true);
    })
    .constant('API_BASE_URL', 'http://api.yat.com');
