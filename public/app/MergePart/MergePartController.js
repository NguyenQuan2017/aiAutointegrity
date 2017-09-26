app.controller('MergePartController', ['$scope','$http', function($scope,$http) {
    $scope.init = function () {
        $http.get('/description')
            .then(function(response) {
                $scope.description = response.data.des;
            });
    }

}]);