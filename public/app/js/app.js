var app = angular.module("AutointegrityApp",['ngRoute','ui.bootstrap','ngAnimate']);
app.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'CarPart/carpart.html',
            controller: 'CarPartController'

        })
}]);