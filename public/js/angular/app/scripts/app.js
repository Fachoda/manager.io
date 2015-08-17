'use strict';

/**
 * @ngdoc overview
 * @name angularApp
 * @description
 * # angularApp
 *
 * Main module of the application.
 */
var app = angular
  .module('Manager', [
    'ngAnimate',
    'ngAria',
    'ngCookies',
    'ngMessages',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'ngMaterial'
  ])
  .config(function ($routeProvider, $mdThemingProvider, $mdIconProvider) {
    $mdThemingProvider.theme('default')
      .primaryPalette('green')
      .accentPalette('red');

    $mdThemingProvider.theme('red')
      .primaryPalette('red');

    $mdIconProvider
      .fontSet('mi', 'material-icons');

    $routeProvider
      .when('/', {
        templateUrl: '/views/main.html'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
