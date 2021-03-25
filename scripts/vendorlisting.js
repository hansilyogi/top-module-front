myApplication.controller("Vendor", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.vendorList = [];
        $scope.modalData = [];
        $scope.route = IMGBASE_URL;
        $scope.loader = false;
        $scope.tabdata = true;

        $scope.pId = 0;

        $scope.vendorlisting = function() {
            $http({
                url: BASE_URL + "vendor/getAllVendor",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data.length != 0) {
                        $scope.vendorList = response.data.Data;
                        $scope.loader = true;
                        $scope.tabdata = false;
                    } else {
                        $scope.loader = true;
                        $scope.tabdata = false;
                        console.log("Opps! Employees Found.");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.vendorlisting();

        $scope.ShowData = function(data) {
            $scope.modalData = data;
        };

        $scope.toggleApproval = function(id) {
            $scope.loader = false;
            $http({
                url: BASE_URL + "admin/vendorUpdate",
                method: "POST",
                cache: false,
                data: { vendorId: id},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data == 1) {
                        $scope.vendorlisting();
                    } else {
                        $scope.vendorlisting();
                        console.log("Opps! Unable to Update");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };

        $scope.DeleteData = function(id) {
            var result = confirm("Do you really want to delete this employee?");
            if (result) {
                $http({
                    url: BASE_URL + "admin/couriersDelete",
                    method: "POST",
                    cache: false,
                    data: { id: id },
                    headers: { "Content-Type": "application/json; charset=UTF-8" },
                }).then(
                    function(response) {
                        if (response.data.Data == 1) {
                            $scope.vendorlisting();
                        } else {
                            console.log("Opps! Unable to Update");
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