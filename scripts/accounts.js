myApplication.controller("Dashboard", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.Id = 0;
        $scope.name = "";
        $scope.username = "";
        $scope.password = "";
        $scope.type = "";

        $scope.saveUser = function() {
            let prepareData = {
                id: $scope.Id,
                name: $scope.name,
                username: $scope.username,
                password: $scope.password,
            };
            $http({
                url: BASE_URL + "admin/couriers",
                method: "POST",
                cache: false,
                data: prepareData,
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data == 1) {
                        console.log("User saved successfully!");
                    } else {
                        console.log("Unable to save user!");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
    },
]);