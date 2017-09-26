app.controller('CarPartController', ['$scope','$http', function($scope,$http) {

    $scope.makes = '';
    $scope.models = '';
    $scope.series = '';
    $scope.badges = '';
    $scope.results = '';
    $scope.search = '';
    $scope.SearchPartNumber = true;
    $scope.CarPartPrice = false;
    $scope.filteredCarPart = [];
    $scope.currentPage = 1;
    $scope.numPerPage = 10;
    $scope.maxSize = 5;
    $scope.init = function () {
        $http.get('/make')
            .then(function(response) {
                $scope.makes = response.data.makes;
            })
    };
    $scope.CarPartPrice = false;
    $scope.changeMake = function () {
        $http.get('/model?makes=' + $scope.make )
            .then(function(response) {
                $scope.models = response.data.models
            });
        $scope.results = '';
        $scope.keywords = '';
        $scope.search = '';

    };
    $scope.ChangeModel = function () {
        $http.get('/series?makes=' + $scope.make + '&models=' + $scope.model)
            .then(function(response) {
                $scope.series = response.data.series;
            });
        $scope.results = '';
        $scope.keywords = '';
        $scope.search = '';
    };

    $scope.ChangeSeries = function () {
        $http.get('/badges?makes=' + $scope.make + '&models=' + $scope.model + '&series=' + $scope.serie)
            .then(function (response) {
                $scope.badges = response.data.badges;
            });
        $scope.results = '';
        $scope.keywords = '';
        $scope.search = '';
    };

    $scope.ChangeBadge = function () {
        $http.get('/results?makes=' + $scope.make + '&models=' + $scope.model + '&series=' + $scope.serie + '&badges=' +$scope.badge )
            .then(function(response) {
                $scope.results = response.data.results;
            });
        $scope.results = '';
        $scope.keywords = '';
        $scope.SearchPartNumber = true;
        $scope.CarPartPrice = false;
        $scope.search = '';
    };

    $scope.Show = function () {
        $scope.make = $scope.make ? $scope.make: '';
        $scope.model = $scope.model ? $scope.model: '';
        $scope.serie = $scope.serie ? $scope.serie: '';
        $scope.badge = $scope.badge ? $scope.badge: '';
        $http.get('/results?makes=' + $scope.make + '&models=' + $scope.model + '&series=' + $scope.serie + '&badges=' +$scope.badge )
            .then(function(response) {
                $scope.results = response.data.results;
            });
        $scope.SearchPartNumber = true;
        $scope.CarPartPrice = false;
    };

    $scope.Search = function () {
        if($scope.search == '')
        {
            $scope.SearchPartNumber = false;
            $scope.CarPartPrice = true;
            $scope.keywords = '';
        }
        else{
        $http.get('/search?keyword=' + $scope.search)
            .then(function(response) {
                $scope.keywords = response.data.search;
            });
        $scope.SearchPartNumber = false;
        $scope.CarPartPrice = true;
        }
    }

}]);


