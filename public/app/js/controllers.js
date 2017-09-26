app.controller('AutoController', function ($scope, $location) {
    // $scope.start = function() {
    //     cfpLoadingBar.start();
    // };
    // $scope.start();
    $scope.isActive = function(route) {
        var active = (route === $location.path());
        return active;
    };

});
app.factory('httpInterceptor', function ($q, $rootScope, $log) {

    var numLoadings = 0;

    return {
        request: function (config) {

            numLoadings++;

            // Show loader
            $rootScope.$broadcast("loader_show");
            return config || $q.when(config)

        },
        response: function (response) {

            if ((--numLoadings) === 0) {
                // Hide loader
                $rootScope.$broadcast("loader_hide");
            }

            return response || $q.when(response);

        },
        responseError: function (response) {

            if (!(--numLoadings)) {
                // Hide loader
                $rootScope.$broadcast("loader_hide");
            }

            return $q.reject(response);
        }
    };
})
    .config(function ($httpProvider) {
        $httpProvider.interceptors.push('httpInterceptor');
    });

app.directive("loader", function ($rootScope) {
    return function ($scope, element, attrs) {
        $scope.$on("loader_show", function () {
            return element.show();
        });
        return $scope.$on("loader_hide", function () {
            return element.hide();
        });
    };
});
