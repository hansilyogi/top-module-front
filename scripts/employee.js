myApplication.controller("Employees", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.employeesList = [];
        $scope.modalData = [];
        $scope.route = IMGBASE_URL;
        $scope.loader = false;
        $scope.tabdata = true;

        $scope.pId = 0;

        $scope.CourierCounter = function() {
            $http({
                url: BASE_URL + "admin/couriers",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data.length != 0) {
                        $scope.employeesList = response.data.Data;
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
        $scope.CourierCounter();

        $scope.ShowData = function(data) {
            $scope.modalData = data;
        };

        $scope.OpenPolice = function(id){
            $scope.pId = id;
            $('#policeModal').modal("toggle");
        }

        $scope.submitPolice = function(){
            var preForm = new FormData();
            angular.forEach($scope.files, function(file) {
                preForm.append("image", file);
            });
            preForm.append("id", $scope.pId);
            
            $http({
                url: BASE_URL + "admin/policeverification",
                method: "POST",
                data: preForm,
                transformRequest: angular.identity,
                headers: { "Content-Type": undefined, "Process-Data": false },
            }).then(function(response) {
                    if (response.data.Data == 1) {
                        alert("Police Verification Image Saved!");
                        $scope.CourierCounter();
                        $("#policeModal").modal("toggle");
                    } else {
                        $scope.btnsave = false;
                        alert("Unable to Save Police Verification Img");
                    }
                },
                function(error) {
                    console.log(error);
                    $scope.btnsave = false;
                }
            );
        }

        $scope.toggleApproval = function(id) {
            $scope.loader = false;
            $http({
                url: BASE_URL + "admin/couriersIsApproval",
                method: "POST",
                cache: false,
                data: { id: id },
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data == 1) {
                        $scope.CourierCounter();
                    } else {
                        $scope.CourierCounter();
                        console.log("Opps! Unable to Update");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };

        $scope.toggleActive = function(id) {
            $scope.loader = false;
            $http({
                url: BASE_URL + "admin/couriersIsActive",
                method: "POST",
                cache: false,
                data: { id: id },
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data == 1) {
                        $scope.CourierCounter();
                    } else {
                        $scope.CourierCounter();
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
                            $scope.CourierCounter();
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