app.controller('CarPartController', ['$scope','$http', function($scope,$http) {

    $scope.make = $scope.make ? $scope.make: '';
    $scope.model = $scope.model ? $scope.model: '';
    $scope.serial = $scope.serial ? $scope.serial: '';
    $scope.badge = $scope.badge ? $scope.badge: '';
    $scope.results = '';
    $scope.search = '';
    $scope.SearchPartNumber = true;
    $scope.CarPartPrice = true;
    $scope.pagination = true;
    $scope.filteredCarPart = [];
    $scope.limitResults = [];
    $scope.currentPage = 1;
    $scope.itemsPerPage = 30;
    $scope.maxSize = 3;
    $scope.init = function () {
        $http.get('/make')
            .then(function(response) {
                $scope.makes = response.data.makes;
            })
    };
    $scope.CarPartPrice = false;
    $scope.changeMake = function () {
        $scope.model = '';
        $scope.serial = '';
        $scope.badge = '';
        $http.get('/model?makes=' + $scope.make )
            .then(function(response) {
                $scope.models = response.data.models
            });
        $scope.results = '';
        $scope.keywords = '';
        $scope.search = '';



    };
    $scope.ChangeModel = function () {
        $scope.serial = '';
        $scope.badge = '';
        $http.get('/series?makes=' + $scope.make + '&models=' + $scope.model)
            .then(function(response) {
                $scope.series = response.data.series;
            });
        $scope.results = '';
        $scope.keywords = '';
        $scope.search = '';


    };

    $scope.ChangeSeries = function () {
        $scope.badge = '';
        $http.get('/badges?makes=' + $scope.make + '&models=' + $scope.model + '&series=' + $scope.serial)
            .then(function (response) {
                $scope.badges = response.data.badges;
            });
        $scope.results = '';
        $scope.keywords = '';
        $scope.badge = '';

    };

    $scope.ChangeBadge = function () {
        $http.get('/results?makes=' + $scope.make + '&models=' + $scope.model + '&series=' + $scope.serial + '&badges=' +$scope.badge )
            .then(function(response) {
                $scope.results = response.data.results;
                $scope.totalItems = $scope.results.length;

                $scope.$watch('currentPage + itemsPerPage', function() {
                    var begin = (($scope.currentPage - 1) * $scope.itemsPerPage),
                        end = begin + $scope.itemsPerPage;

                    $scope.limitResults = $scope.results.slice(begin, end);
                });
            });
        $scope.results = '';
        $scope.keywords = '';
        $scope.SearchPartNumber = true;
        $scope.CarPartPrice = false;
        $scope.search = '';
        $scope.pagination = false;
        $scope.currentPage = 1;

    };

    $scope.Show = function () {

         $http.get('/results?makes=' + $scope.make + '&models=' + $scope.model + '&series=' + $scope.serial + '&badges=' +$scope.badge )
            .then(function(response) {
                $scope.results = response.data.results;

                $scope.totalItems = $scope.results.length;
                $scope.$watch('currentPage + itemsPerPage', function() {
                    var begin = (($scope.currentPage - 1) * $scope.itemsPerPage),
                        end = begin + $scope.itemsPerPage;

                    $scope.limitResults = $scope.results.slice(begin, end);
                });

            });
        $scope.keywords = '';
        $scope.SearchPartNumber = true;
        $scope.CarPartPrice = false;
        $scope.currentPage = 1;
        $scope.search = '';
        $scope.pagination = false;
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
                $scope.totalItems = $scope.keywords.length;
                $scope.$watch('currentPage + itemsPerPage', function() {
                    var begin = (($scope.currentPage - 1) * $scope.itemsPerPage),
                        end = begin + $scope.itemsPerPage;
                    $scope.limitSearch = $scope.keywords.slice(begin, end);
                });
            });
        $scope.results = '';
        // $scope.keywords = '';
        $scope.SearchPartNumber = false;
        $scope.CarPartPrice = true;
        $scope.pagination = false;
        $scope.currentPage = 1;
        $scope.make = '';
        $scope.model = '';
        $scope.serial = '';
        $scope.badge = '';

        }
    };

    $scope.ShowPart = function (make, model, serial, badge) {
        $scope.make = make ? make : '' ;
        $scope.model = model ? model : '';
        $scope.serial = serial ? serial : '';
        $scope.badge = badge ? badge : '';
        if(make) {
            $http.get('/model?makes=' + $scope.make )
                .then(function(response) {
                    $scope.models = response.data.models;
                    console.log($scope.model);
                });
            if(model) {
                $http.get('/series?makes=' + $scope.make + '&models=' + $scope.model)
                    .then(function(response) {
                        $scope.series = response.data.series;
                        console.log($scope.series);
                    });
            }
            if(serial) {
                $http.get('/badges?makes=' + $scope.make + '&models=' + $scope.model + '&series=' + $scope.serial)
                    .then(function (response) {
                        $scope.badges = response.data.badges;
                        console.log($scope.badges);
                    });
            }
        }
            $http.get('/showPart?makes=' + $scope.make + '&models=' + $scope.model + '&series=' + $scope.serial + '&badges=' + $scope.badge)
                .then(function(response) {
                    $scope.results = response.data.results;
                    $scope.totalItems = $scope.results.length;
                    $scope.$watch('currentPage + itemsPerPage', function() {
                        var begin = (($scope.currentPage - 1) * $scope.itemsPerPage),
                            end = begin + $scope.itemsPerPage;
                        $scope.limitResults = $scope.results.slice(begin, end);
                    });
                });

        $scope.SearchPartNumber = true;
        $scope.CarPartPrice = false;
        $scope.pagination = false;
        $scope.currentPage = 1;
        $scope.keywords = '';
        $scope.resutls = '';
    }


}]);


