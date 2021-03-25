myApplication.controller("mainheadControl", [
    "$scope",
    "$http",
    function($scope, $http) {
        $scope.username = sessionStorage.getItem("Name");

        $scope.logOutData = function() {
            sessionStorage.clear();
            window.location.href = "index.php";
        };


        // $scope.ordersCountm = 0;
        $scope.totalproject = 0;
        $scope.completeproject = 0;
        $scope.runningproject = 0;
        $scope.vendorCount = 0;
        $scope.staffCount = 0;
        $scope.customerCount = 0;

        $scope.DashboardCounters = function() {
            $http({
                url: BASE_URL + "admin/dashcounters",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.IsSuccess === true) {
                        let dataset = response.data.Data;
                        $scope.totalproject = dataset[0].totalSite;
                        $scope.completeproject = dataset[0].completedSite;
                        $scope.runningproject = dataset[0].runningSite;
                        $scope.customerCount = dataset[0].customerCount;
                        $scope.staffCount = dataset[0].staffCount;
                        $scope.vendorCount = dataset[0].vendorCount;
                        // $scope.pendingOrdersm = dataset[0].pendingOrders;
                        // $scope.disapporved = dataset[0].disapporved;
                    } else {
                        console.log("Opps! Something Went Wrong.");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.DashboardCounters();

        $scope.getCourierLocation = function() {
            $http({
                url: BASE_URL + "admin/getLiveLocation",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    $("#empcounter").html(response.data.length);
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        // $scope.getCourierLocation();
    },
]);