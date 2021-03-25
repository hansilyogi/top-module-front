myApplication.controller("Vendororder", [
    "$scope",
    "$http",
    function ($scope, $http) {
      if (sessionStorage.getItem("SessionId") == null) {
        window.location.href = "index.php";
      }

      $( "#ofDate" ).datepicker({
        format: 'dd/mm/yyyy',
        // defaultDate:"24-09-2019",
        changeMonth: true,
        changeYear: true
      });

      $scope.orderList = [];
      $scope.otherdata ;
      $scope.empList = [];
      $scope.resData ;

      // BASE_URL = "https://pick-and-delivery.herokuapp.com/";

    $scope.getdata1 = function(){
        $("#displaydata").html("");
        $http({
            url : BASE_URL + "vendor/getAllVendorOrderListing",
            method : "POST",
            cache : false,
            data : {
            ofDate : $("#ofDate").val(),
            },
            headers: { "Content-Type": "application/json; charset=UTF-8" },
        }).then(
            function (response) {
            console.log(response);
            $scope.resData = response.data.Data;
            $scope.Totalvendorbill = 0;
            $scope.Totalamtcoll = 0;
            $scope.Totalcouriercharge = 0;
            $scope.Totaldel = 0;
            $scope.Totaldis = 0;
            if($scope.resData){
                for(i =0; i< response.data.Data.length; i++){
                    j=i+1;
                    // $scope.Totalamt += response.data.Data[i].TotalPrice;
                    $scope.Totalamtcoll += response.data.Data[i].VendorAmountCollect;
                    $scope.Totalcouriercharge += response.data.Data[i].CourierCharge;
                    $scope.Totaldel += response.data.Data[i].TotalDelivery;
                    $scope.Totaldis += response.data.Data[i].DeliveryData.distance;
                    $scope.Totalvendorbill += response.data.Data[i].VendorBill;
                    var x = response.data.Data[i].CourierChargeCollectFromCustomerIs == true ? 'Customer' : 'Vendor';
                    var vendorbill = response.data.Data[i].VendorBill - response.data.Data[i].CourierCharge;
                    $("#displaydata").append(
                    "<tr><td>" +
                    response.data.Data[i].VendorName +
                    "</td><td>" +
                    response.data.Data[i].DeliveryData.name +
                    "</td><td>" +
                    response.data.Data[i].DeliveryData.distance +
                    "</td><td>" +
                    response.data.Data[i].VendorAmountCollect +
                    "</td><td>" +
                    response.data.Data[i].CourierCharge +
                    "</td><td>" +
                    x +
                    "</td><td>" +
                    vendorbill +
                    "</td></tr>"
                    );
                }
                $scope.Totalamtcoll = $scope.Totalamtcoll;
                $scope.Totalcouriercharge = $scope.Totalcouriercharge;
                $scope.Totaldel = i;
                $scope.Totaldis = $scope.Totaldis;
                $scope.Totalamt = $scope.Totalamt;
                $scope.Totalvendorbill = $scope.Totalamtcoll - $scope.Totalcouriercharge;
            }
            else{
            $("#displaydata").html(
                "<tr><td colspan=6 class='text-center font-weight-bold'>" +
                data.Message +
                "</td></tr>"
            );
            }
        //   console.log($scope.Totalamt);
            }
        );
    };


    $(document).on("click", "#btn-search-date", function (e) {
        e.preventDefault();
        $scope.getdata1();
    });

    }
]);