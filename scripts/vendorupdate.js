myApplication.controller("vendorupdate", [
    "$scope",
    "$http",
    function ($scope, $http) {
      if (sessionStorage.getItem("SessionId") == null) {
        window.location.href = "index.php";
      }

      $scope.orderList = [];
      $scope.otherdata ;
      $scope.empList = [];
      $scope.resData ;
      $scope.vendorList = [];
      // BASE_URL = "https://pick-and-delivery.herokuapp.com/";

        $scope.vendorlisting = function() {
            $http({
                url: BASE_URL + "vendor/getAllVendor",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    for (i = 0; i < response.data.Data.length; i++) {
                        $("#vendorId").append(
                          "<option value=" +
                            response.data.Data[i]._id +
                            ">" +
                            response.data.Data[i].name +
                            "</option>"
                        );
                    }
                    if (response.data.Data.length != 0) {
                        $scope.vendorList = response.data.Data;
                        $scope.loader = true;
                        $scope.tabdata = false;
                    } else {
                        $scope.loader = true;
                        $scope.tabdata = false;
                        console.log("Opps! Vendor Found.");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.vendorlisting();

        $scope.getdata = function(){
            $http({
                url: BASE_URL + "vendor/updateVendorCharge",
                method: "POST",
                cache: false,
                data: { vendorId : $("#vendorId").val(), 
                        FixKm : $("#FixKm").val(), 
                        UnderFixKmCharge : $("#UnderFixKmCharge").val(), 
                        perKmCharge : $("#perKmCharge").val()
                    },
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then( function (respose) {
                console.log(respose);
                location.reload();
                // $scope.vendorlisting();
            });
        };

        $(document).on("click", "#btn-date", function (e) {
          e.preventDefault();
          $scope.getdata();
        });

      

    }
]);