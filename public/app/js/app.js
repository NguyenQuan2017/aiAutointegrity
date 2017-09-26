var app = angular.module("AutointegrityApp",['ngRoute']);
app.config(['$routeProvider', function($routeProvider) {
    $routeProvider

        .when('/carpart', {
            templateUrl: 'CarPart/carpart.html',
            controller: 'CarPartController'

        })
        .when('/mergepart', {
            templateUrl: 'MergePart/merge-part.html',
            controller: 'MergePartController'

        })

}]);