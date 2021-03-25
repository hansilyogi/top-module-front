myApplication.controller("CourierLogger", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.courierLoogger = [];

        $scope.getLogger = function() {
            $http({
                url: BASE_URL + "admin/courierlogs",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(function(response) {
                    if (response.data.Data.length != 0) {
                        $scope.courierLoogger = [];
                        $scope.courierLoogger = response.data.Data;
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        }
        $scope.getLogger();


        $scope.OpenMap = function(lat, long) {
            let link = "http://www.google.com/maps/place/" + lat + "," + long;
            window.open(link, "_blank");
        }

    },
]);