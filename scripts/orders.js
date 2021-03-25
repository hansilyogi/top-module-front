myApplication.controller("Orders", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.route = BASE_URL_3;

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
        $scope.errmsg = "";
        $scope.scheduletime = [];
        $scope.OrderData = function() {
            $scope.loader = false;
            $scope.tabdata = true;
            $http({
                url: BASE_URL + "admin/orders_V1",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    console.log(response);
                    if (response.data.Data.length != 0) {

                        $scope.totalpending = response.data.Data.PendingOrder.length;
                        $scope.totalrunning = response.data.Data.RunningOrder.length;
                        // $scope.totalcancelled = response.data.Data.cancelledOrders.length;
                        // $scope.totalcancelled = response.data.Data[0].cancelledOrders.length;
                         
                        // $scope.totalcancelled = 0;
                        $scope.totalcompleted = 0;//response.data.Data[0].completeOrders.length;

                        // $scope.completeOrders = response.data.Data[0].completeOrders;
                        $scope.pendingOrders = response.data.Data.PendingOrder;
                        console.log($scope.pendingOrders);
                        // for(i=0;i < $scope.pendingOrders.length;i++){
                        //     if($scope.pendingOrders[i].schedualDateTime){
                        //         $scope.scheduletime[i] = $scope.pendingOrders[i].schedualDateTime.split("T");
                        //     }
                        //     else{
                        //         $scope.scheduletime[i] = "";
                        //     }
                        // };
                        $scope.runningOrders = response.data.Data.RunningOrder;
                        // $scope.cancelledOrders = 0;
                        // $scope.cancelledOrders = response.data.Data[0].cancelledOrders;
                        //$scope.cancelledOrders = response.data.Data[0].cancelledOrders;

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

        $scope.getdata1 = function() {
            $http({
                url: BASE_URL + "admin/getCancelSingleDeliveryOrders",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response){
                    console.log(response);
                    if(response.data.IsSuccess == true){
                        $scope.cancelledOrders = response.data.Data;
                        console.log($scope.cancelledOrders);
                        $scope.totalcancelled = response.data.CancelOrderCount;
                    }
                }
            );
        };

        $(document).on("click", "#cancelledorders", function (e) {
            e.preventDefault();
          $scope.getdata1();
        });
        
        //completed  order details start
        $scope.CompletedOrderData = function() {
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
                    if (response.data.Data.length != 0) {

                        $scope.totalcompleted = response.data.Data[0].completeOrders.length;

                        $scope.completeOrders = response.data.Data[0].completeOrders;
                        
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
        
        $scope.OrderData();

        $scope.AssignPoup = function(orderId, orderNo) {
            $scope.orderNo = orderNo;
            $scope.orderId = orderId;
            $scope.getAvailableBoys();
            $("#AssignOrders").modal();
        };

        $scope.getAvailableBoys = function() {
            $scope.errmsg = "Refreshing...";
            $http({
                url: BASE_URL + "admin/getAvailableBoys",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    $scope.availableData = response.data.Data;
                    $scope.errmsg = "";
                },
                function(error) {
                    console.log(error);
                }
            );
        };

        $scope.AssignOrderTODB = function() {
            let data = {
                courierId: $scope.selectedDeliveryBoy,
                orderId: $scope.orderId,
            };
            $http({
                url: BASE_URL + "admin/AssignOrder",
                method: "POST",
                cache: false,
                data: data,
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data == 1 && response.data.IsSuccess == true) {
                        alert("Order Assigned Successfully!");
                        $scope.OrderData();
                    } else if (
                        response.data.Data == 0 &&
                        response.data.IsSuccess == true
                    ) {
                        alert("Order Cancelled By Customer!");
                        $scope.OrderData();
                    } else {
                        console.log("Something Went Wrong!");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };

        $scope.CancelOrder = function(newid) {
            let data = { id: newid };
            let result = confirm("Do you want to cancel this order?");
            if (result) {
                $http({
                    url: BASE_URL + "admin/cancelOrder",
                    method: "POST",
                    cache: false,
                    data: data,
                    headers: { "Content-Type": "application/json; charset=UTF-8" },
                }).then(
                    function(response) {
                        if (response.data.Data == 1) {
                            alert("Order Cancelled Successfully!");
                            $scope.OrderData();
                        } else {
                            $scope.OrderData();
                        }
                    },
                    function(error) {
                        console.log(error);
                    }
                );
            }
        };

        $scope.restoreorder = function(newid) {
            let data = { id: newid };
            let result = confirm("Do you want to Restore this order?");
            if (result) {
                $http({
                    url: BASE_URL + "admin/restoreOrder",
                    method: "POST",
                    cache: false,
                    data: data,
                    headers: { "Content-Type": "application/json; charset=UTF-8" },
                }).then(
                    function(response) {
                        
                        if (response.data.Data == 1) {
                            alert("Order Restored Successfully!");
                            $scope.OrderData();
                        } else {
                            $scope.OrderData();
                        }
                    },
                    function(error) {
                        console.log(error);
                    }
                );
            }
        };
    },
]);