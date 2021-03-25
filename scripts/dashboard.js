myApplication.controller("Dashboard", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }
        $scope.proData;
        $scope.imgroute = "http://localhost:3000/";

        $scope.getprojectData = function(){
            $http({
                url: BASE_URL + "admin/getAllproject",
                method: "POST",
                cache: false,
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response){
                    console.log(response);
                    $scope.proData = response.data.Data;
                }
            )
        };
        $scope.getprojectData();
    },
]);