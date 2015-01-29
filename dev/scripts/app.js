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
    'ngSanitize',
    'ngTouch'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
        .when('/category/:id', {
            templateUrl: 'views/category.html',
            controller: 'CategoryCtrl'
        })
        .when('/article/:id', {
            templateUrl: 'views/article.html',
            controller: 'ArticleCtrl'
        })
      .otherwise({
        redirectTo: '/'
      });
  });
