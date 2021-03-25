myApplication.controller("Singleemp", [
    "$scope",
    "$http",
    function ($scope, $http) {
      if (sessionStorage.getItem("SessionId") == null) {
        window.location.href = "index.php";
      }

      $( "#startdate" ).datepicker({
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
      
      $scope.getemployee = function(){
            $http({
                url: BASE_URL + "admin/getAllEmployee",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
              }).then(
                function (response) {
                  if (response.data.Data.length != 0) {
                    $scope.empList = [];
                    $scope.empList = response.data.Data;
                  }
                  for (i = 0; i < response.data.Data.length; i++) {
                    $("#courierId").append(
                      "<option value=" +
                        response.data.Data[i]._id +
                        ">" +
                        response.data.Data[i].firstName + " " + response.data.Data[i].lastName +
                        "</option>"
                    );
                  }
                },
                function (error) {
                  console.log(error);
                }
            );
        };
        $scope.getemployee();

        $scope.getdata =function(){
          console.log("asd");
          $http({
            method: "POST",
            url: BASE_URL + "couriers/getEmployeeOrderDetailsV2",
            data: {
              courierId : $("#courierId").val(),
              ofDate: $("#startdate").val(),
            },
            headers: { "Content-Type": "application/json; charset=UTF-8" },
            // dataType: "json",
            cache: false,
          }).then(
            function(response){
              $("#displaydata").html("");
              $scope.otherdata = response.data;
              console.log(response);
              // $('#totalamount').html("Total Amount collected - Rs ");
              // $('#totalkm').html("Total KM Travelled - ");
              // $('#totalorder').html("Total Orders - ");
              // $('#totalamount').append(response.data.TotalPriceCollected);
              // $('#totalkm').append(response.data.TotalDistanceTravell);
              // $('#totalorder').append(response.data.TotalOrders);
                    $scope.Totalamt = 0;
                    $scope.Totaldis = 0;
                    $scope.Totaldel = 0;
                  if (response.data.IsSuccess == true && response.data.Data != 0) {
                    $scope.Totaldel = response.data.TotalOrders;
                        $scope.Totaldis = response.data.TotalDistanceTravell;
                        $scope.Totalamt = response.data.TotalPriceCollected;
                    if (response.data.Data.length > 0) {
                      for (i = 0; i < response.data.Data.length; i++) {
                        j=i+1;
                        $("#displaydata").append(
                            "<tr><td>" +
                            j +
                            "</td><td>" +
                            response.data.Data[i].pickupPoint.name +
                            "</td><td>" +
                            response.data.Data[i].pickupPoint.address +
                            "</td><td>" +
                            response.data.Data[i].deliveryPoint.name +
                            "</td><td>" +
                            response.data.Data[i].deliveryPoint.address +
                            "</td><td>" +
                            response.data.Data[i].amountCollection +
                            "</td><td>" +
                            response.data.Data[i].finalAmount +
                            "</td></tr>"
                        );
                      }
                    }
                  } else {
                    $("#displaydata").html(
                      "<tr><td colspan=6 class='text-center font-weight-bold'>" +
                        "Record not Found" +
                        "</td></tr>"
                    );
                  }
              },
          );
        };


        $(document).on("click", "#btn-date", function (e) {
          e.preventDefault();
          console.log("1");
          $scope.getdata();
        });

      

    }
]);


// $("#displaydata").append(
//     "<tr><td>" +
//     j +
//     "</td><td>" +
//     response.data.Data[i].pickupPoint.name +
//     "</td><td>" +
//     response.data.Data[i].pickupPoint.address +
//     "</td><td>" +
//     response.data.Data[i].deliveryPoint.name +
//     "</td><td>" +
//     response.data.Data[i].deliveryPoint.address +
//     "</td><td>" +
//     response.data.Data[i].deliveryPoint.distance +
//     "</td><td>" +
//     response.data.Data[i].amount +
//     "</td><td>" +
//     response.data.Data[i].amountCollection +
//     "</td><td>" +
//     response.data.Data[i].additionalAmount +
//     "</td><td>" +
//     response.data.Data[i].discount +
//     "</td><td>" +
//     response.data.Data[i].finalAmount +
//     "</td><td>" +
//     response.data.Data[i].deliveryType +
//     "</td></tr>"
// );