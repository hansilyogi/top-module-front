myApplication.controller("ExtraKilometer", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.courierLogger = [];

        $scope.getLogger = function() {

        }
        $scope.getLogger();

    },
]);