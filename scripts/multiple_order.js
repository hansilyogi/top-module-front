myApplication.controller("multiple_order", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }
        $scope.datesa = new Date();
        $scope.loader = true;
        var map;
        var infowindow = new google.maps.InfoWindow();
        var markers = [];
        var beaches = [];
        $scope.availableData = [];
        // $scope.setMarkers = function(locations) {
        //     var i;
        //     for (i = 0; i < locations.length; i++) {
        //         var image = {
        //             url: "dist/mapmark.png",
        //             scaledSize: new google.maps.Size(28, 50),
        //         };
        //         var marker = new google.maps.Marker({
        //             position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        //             map: map,
        //             icon: image,
        //             title: locations[i][0],
        //             zIndex: locations[i][3],
        //         });
        //         google.maps.event.addListener(
        //             marker,
        //             "click",
        //             (function(marker, i) {
        //                 return function() {
        //                     infowindow.setContent(locations[i][0]);
        //                     infowindow.open(map, marker);
        //                 };
        //             })(marker, i)
        //         );
        //         markers.push(marker);
        //     }
        // };

        // $scope.reloadMarkers = function() {
        //     for (var i = 0; i < markers.length; i++) {
        //         markers[i].setMap(null);
        //     }
        //     markers = [];
        //     $scope.setMarkers(beaches);
        // };

        // $scope.initialize = function() {
        //     var mapOptions = {
        //         zoom: 14.08,
        //         center: new google.maps.LatLng(21.1668112, 72.8317359),
        //         mapTypeId: google.maps.MapTypeId.ROADMAP,
        //     };

        //     map = new google.maps.Map(document.getElementById("map"), mapOptions);

        //     $scope.setMarkers(beaches);
        //     $scope.reloadMarkers();
        // };
        // $scope.initialize();

        $scope.locationcounter = 0;
        $scope.couriersList = [];
        $scope.avl = [];
        $scope.totalpendingOrders = 0;
        $scope.PendingOrders = [];

        $scope.OrderData = function() {
            $http({
                // url: BASE_URL + "admin/getMultipleDeliveryOrder",
                url: "https://pnd-back.herokuapp.com/admin/getMultipleDeliveryOrder",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    console.log(response);
                    if (response.data.Data.length != 0) {
                        // $scope.totalpendingOrders = response.data.Data[0].pendingOrders.length;
                        // $scope.PendingOrders = response.data.Data[0].pendingOrders;
                        $scope.RunningOrders = response.data.Data.RunningOrder;
                        $scope.PendingOrders = response.data.Data.PendingOrder;
                        $scope.totalpendingOrders = response.data.PendingOrderCount;
                        $scope.totalrunningOrders = response.data.RunningOrderCount;
                        
                        $scope.loader = false;
                    } else {
                        console.log("No Orders Found!");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.OrderData();

        $scope.AssignPoup = function(orderId, orderNo) {
            $scope.orderNo = orderNo;
            $scope.orderId = orderId;
            $scope.getAvailableBoys();
            $("#AssignOrders").modal();
        };

        $scope.getdata1 = function() {
            $http({
                url: BASE_URL + "admin/getMultiDeliveryCancelOrder",
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

        $(document).on("click", "#multicancelledorders", function (e) {
            e.preventDefault();
          $scope.getdata1();
        });

        $scope.getAvailableBoys = function() {
            $scope.errmsg = "Refreshing...";
            $http({
                url: BASE_URL + "admin/getAvailableBoys_V2",
                method: "POST",
                cache: false,
                data: { "orderNo" : $scope.orderNo },
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
                orderId: $scope.orderNo,
            };
            $http({
                url: BASE_URL + "admin/AssignOrder_V1",
                // url : "http://192.168.29.99:3000/admin/AssignOrder_V1",
                method: "POST",
                cache: false,
                data: data,
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    console.log(response);
                    if (response.data.Data == 1 && response.data.IsSuccess == true) {
                        alert("Order Assigned Successfully!");
                        $scope.OrderData();
                    } else if (
                        response.data.Data == 0 &&
                        response.data.IsSuccess == true
                    ) {
                        alert("Order Cancelled By Employee!");
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

        $scope.getCourierLocation = function() {
            $http({
                url: BASE_URL + "admin/getLiveLocation",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    $scope.locationcounter = response.data.length;
                    console.log(response.data);
                    beaches = response.data;
                    // $scope.reloadMarkers();
                    if (beaches.length == 0) {
                        console.log("No Delivery Boys with ON Duty");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.getCourierLocation();

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


        setInterval(() => {
            $scope.getCourierLocation();
            //$scope.OrderData();
        }, 10000);
    },
]);