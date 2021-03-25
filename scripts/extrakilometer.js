myApplication.controller("ExtraKilometer", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.orderModelId = "";
        $scope.OrderDetails = [];
        $scope.Kilometers = [];
        $scope.FullData = [];
        $scope.Courier = [];
        $scope.url = IMGBASE_URL;
        $scope.FromDate;
        $scope.ToDate;
        $scope.loader = true;

        $scope.filterData = function() {
            $scope.loader = true;
            let preparedData = {
                FromDate: new Date(new Date($scope.FromDate).setHours(0, 0, 0)),
                ToDate: new Date(new Date($scope.ToDate).setHours(0, 0, 0)),
            };
            console.log(preparedData);
            $http({
                url: BASE_URL + "admin/ftExtraKms",
                method: "POST",
                cache: false,
                data: preparedData,
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    $scope.Kilometers = [];
                    if (response.data.Data.length != 0) {
                        $scope.FullData = response.data.Data;
                        console.log(response.data.Data);
                        let dataset = response.data.Data;
                        for (let i = 0; i < dataset.length; i++) {
                            let p1 = new google.maps.LatLng(
                                Number(dataset[i].blat),
                                Number(dataset[i].blong)
                            );
                            let p2 = new google.maps.LatLng(
                                Number(dataset[i].plat),
                                Number(dataset[i].plong)
                            );
                            let extraKM = $scope.calcDistance(p1, p2);

                            let p3 = new google.maps.LatLng(
                                Number(dataset[i].orderId.pickupPoint.lat),
                                Number(dataset[i].orderId.pickupPoint.long)
                            );
                            let p4 = new google.maps.LatLng(
                                Number(dataset[i].orderId.deliveryPoint.lat),
                                Number(dataset[i].orderId.deliveryPoint.long)
                            );
                            let travelKm = $scope.calcDistance(p3, p4);

                            let total = Number(extraKM) + Number(travelKm);
                            $scope.Kilometers.push({
                                courierId: dataset[i].courierId._id,
                                courierNo: dataset[i].courierId.cId,
                                orderNo: dataset[i].orderId.orderNo,
                                orderId: dataset[i].orderId._id,
                                extraKM: isNaN(extraKM) === false ? extraKM + " KM" : "-",
                                travelKM: isNaN(travelKm) === false ? travelKm + " KM" : "-",
                                total: isNaN(total) === false ? total + " KM" : "-",
                            });
                        }
                        $scope.loader = false;
                    } else {
                        $scope.Kilometers = [];
                        $scope.loader = false;
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };

        $scope.getDefaultKilometer = function() {
            $http({
                url: BASE_URL + "admin/todaysExtraKms",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    $scope.Kilometers = [];
                    if (response.data.Data.length != 0) {
                        $scope.FullData = response.data.Data;
                        let dataset = response.data.Data;
                        for (let i = 0; i < dataset.length; i++) {
                            let p1 = new google.maps.LatLng(
                                Number(dataset[i].blat),
                                Number(dataset[i].blong)
                            );
                            let p2 = new google.maps.LatLng(
                                Number(dataset[i].plat),
                                Number(dataset[i].plong)
                            );
                            let extraKM = $scope.calcDistance(p1, p2);

                            let p3 = new google.maps.LatLng(
                                Number(dataset[i].orderId.pickupPoint.lat),
                                Number(dataset[i].orderId.pickupPoint.long)
                            );
                            let p4 = new google.maps.LatLng(
                                Number(dataset[i].orderId.deliveryPoint.lat),
                                Number(dataset[i].orderId.deliveryPoint.long)
                            );
                            let travelKm = $scope.calcDistance(p3, p4);

                            let total = Number(extraKM) + Number(travelKm);
                            $scope.Kilometers.push({
                                courierId: dataset[i].courierId._id,
                                courierNo: dataset[i].courierId.cId,
                                orderNo: dataset[i].orderId.orderNo,
                                orderId: dataset[i].orderId._id,
                                extraKM: isNaN(extraKM) === false ? extraKM + " KM" : "-",
                                travelKM: isNaN(travelKm) === false ? travelKm + " KM" : "-",
                                total: isNaN(total) === false ? total + " KM" : "-",
                            });
                        }

                        $scope.loader = false;
                    } else {
                        $scope.Kilometers = [];
                        $scope.loader = false;
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.getDefaultKilometer();

        $scope.findOrder = function(id, modalid) {
            $scope.OrderDetails = [];
            localOrder = [];
            $scope.orderModelId = modalid;
            for (let i = 0; i < $scope.FullData.length; i++) {
                if ($scope.FullData[i].orderId._id == id) {
                    localOrder.push($scope.FullData[i].orderId);
                }
            }
            if (localOrder.length != 0) {
                $("#orderModal").modal();
                $scope.OrderDetails = localOrder;
            }
        };

        $scope.findCourier = function(id, orderid) {
            $scope.Courier = [];
            let localCourier = [];
            for (let i = 0; i < $scope.FullData.length; i++) {
                if (
                    $scope.FullData[i].courierId._id == id &&
                    $scope.FullData[i].orderId._id == orderid
                ) {
                    localCourier.push($scope.FullData[i].courierId);
                }
            }
            if (localCourier.length != 0) {
                $("#courierModal").modal();
                $scope.Courier = localCourier;
            }
        };

        $scope.calcDistance = function(p1, p2) {
            return (
                google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000
            ).toFixed(2);
        };
    },
]);