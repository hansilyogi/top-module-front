myApplication.controller("Completedorder", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }
        $scope.route = BASE_URL;

        $scope.completeOrders = [];
        $scope.pendingOrders = [];
        $scope.cancelledOrders = [];
        $scope.runningOrders = [];

        $scope.totalpending = 0;
        $scope.totalrunning = 0;
        $scope.totalcancelled = 0;
        $scope.totalcompleted = 0;

        $scope.orderNo = "";
        $scope.orderId = "";
        $scope.availableData = [];
        $scope.errmsg;
        
        CompletedOrderData();
        //completed  order details start
         function CompletedOrderData() {
            $scope.loader = false;
            $scope.tabdata = true;
            $http({
                url: BASE_URL + "admin/completed_orders",
                method: "POST",
                cache: false,
                data: {},
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