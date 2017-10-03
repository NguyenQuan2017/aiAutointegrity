var app = angular.module("AutointegrityApp",['ngRoute']);
app.config(['$routeProvider', function($routeProvider) {
    $routeProvider

        .when('/', {
            templateUrl: 'CarPart/carpart.html',
            controller: 'CarPartController'

        })
}]);