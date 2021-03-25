myApplication.controller("Currenrtorder", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }
        $scope.route = BASE_URL_3;

        $scope.completeOrders = [];

        $scope.totalcompleted = 0;

        $scope.orderNo = "";
        $scope.orderId = "";
        $scope.availableData = [];
        $scope.errmsg;
        http://13.126.231.240/
        currentorder();
        //completed  order details start
         function currentorder() {
            $scope.loader = false;
            $scope.tabdata = true;
            $http({
                url: "http://13.126.231.240/" + "admin/currentorder",
                method: "POST",
                cache: false,
                data : {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    console.log(response);
                    if (response.data.Data.length != 0) {

                        $scope.totalcompleted = response.data.Data.length;

                        $scope.completeOrders = response.data.Data;
                        
                        $scope.loader = true;
                        $scope.tabdata = false;

                    } else {
                        $scope.loader = true;
                        $scope.tabdata = false;
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        //completed  order details end 
    },
]);