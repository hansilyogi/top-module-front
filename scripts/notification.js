myApplication.controller("Notification", ["$scope", "$http", function($scope, $http) {

    if (sessionStorage.getItem("SessionId") == null)
        window.location.href = "index.php";

    $scope.Types = [{ Name: 'SMS', Selected: false }, { Name: 'NOTIFICATION', Selected: false }];
    $scope.listing = [{ id: 1, name: "Employees" }, { id: 2, name: "Customers" }];
    $scope.listData = "List of Employees";
    $scope.whom = "1";
    $scope.selectedCourier = [];
    $scope.getcouriers = [];

    $scope.getcourierVia = () => {
        $scope.getcouriers = [];
        $http({
            url: BASE_URL + "admin/couriers",
            method: "POST",
            cache: false,
            data: {},
            headers: { "Content-Type": "application/json; charset=UTF-8" },
        }).then(
            function(response) {
                if (response.data.Data.length != 0) {
                    let getList = response.data.Data;
                    for (let i = 0; i < getList.length; i++) {
                        $scope.getcouriers.push({
                            id: getList[i]._id,
                            name: getList[i].firstName + ' ' + getList[i].lastName,
                            mobileNo: getList[i].mobileNo,
                            fcmToken: getList[i].fcmToken,
                            selected: false
                        });
                    }
                } else {
                    $scope.getcouriers = [];
                    $scope.getcouriers = response.Data;
                }
            },
            function(error) {
                console.log(error);
            }
        );
    }
    $scope.getcourierVia();

    $scope.getcustomersVia = () => {
        $scope.getcouriers = [];
        $http({
            url: BASE_URL + "admin/customers",
            method: "POST",
            cache: false,
            data: {},
            headers: { "Content-Type": "application/json; charset=UTF-8" },
        }).then(
            function(response) {
                if (response.data.Data.length != 0) {
                    let getList = response.data.Data;
                    for (let i = 0; i < getList.length; i++) {
                        $scope.getcouriers.push({
                            id: getList[i]._id,
                            name: getList[i].name,
                            mobileNo: getList[i].mobileNo,
                            fcmToken: getList[i].fcmToken,
                            selected: false
                        });
                    }
                } else {
                    $scope.getcouriers = [];
                    $scope.getcouriers = response.Data;
                }
            },
            function(error) {
                console.log(error);
            }
        );
    }

    $scope.whomchange = () => {
        $scope.checkall = false;
        if ($scope.whom == 1) {
            $scope.listData = "List of Employees";
            $scope.getcourierVia();
        } else if ($scope.whom == 2) {
            $scope.listData = "List of Customers";
            $scope.getcustomersVia();
        } else {
            $scope.listData = "Sorry Nothing Selected";
            $scope.getcouriers = [];
        }
    }

    $scope.ToogleCheck = function() {
        if ($scope.checkall == true) {
            for (let i = 0; i < $scope.getcouriers.length; i++) {
                $scope.getcouriers[i].selected = true;
            }
        } else {
            for (let i = 0; i < $scope.getcouriers.length; i++) {
                $scope.getcouriers[i].selected = false;
            }
        }
    }

    $scope.sendNotifcation = () => {
        let finalData = [];
        let finalSelection = [];
        for (let i = 0; i < $scope.getcouriers.length; i++) {
            if ($scope.getcouriers[i].selected == true) {
                finalData.push($scope.getcouriers[i]);
            }
        }

        for (let i = 0; i < $scope.Types.length; i++) {
            if ($scope.Types[i].Selected == true) {
                finalSelection.push($scope.Types[i]);
            }
        }

        if (finalSelection.length != 0) {
            if (finalData.length != 0) {
                let datalist = {
                    title: $scope.title,
                    message: $scope.description,
                    service: finalSelection,
                    data: finalData
                };
                $http({
                    url: BASE_URL + "admin/sendNToPND",
                    method: "POST",
                    cache: false,
                    data: datalist,
                    headers: { "Content-Type": "application/json; charset=UTF-8" },
                }).then(
                    function(response) {
                        if (response.data.Data == 1) {
                            alert("Process Complete!");
                        } else {
                            alert("Process Incomplete!");
                        }
                    },
                    function(error) {
                        console.log(error);
                    }
                );
            } else
                alert("No Data Selected");
        } else
            alert("Please Select SMS or Notification");

    }

}]);