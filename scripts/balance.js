myApplication.controller("Balance", [
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
      $scope.Totalamt = 0;
      $scope.Totalamtcoll = 0;
      $scope.Totalthird = 0;
      $scope.Totaldel = 0;
      $scope.Totaldis = 0;

      // BASE_URL = "https://pick-and-delivery.herokuapp.com/";

      $scope.getdata1 = function(){
        $http({
          url : BASE_URL + "couriers/getAllEmployeeOrderHistory",
          method : "POST",
          cache : false,
          data : {
            ofDate : $("#startdate").val(),
          },
          headers: { "Content-Type": "application/json; charset=UTF-8" },
        }).then(
          function (response) {
          console.log(response);
          $scope.resData = response.data.Data;
          if($scope.resData){
            for(i =0; i< response.data.Data.length; i++){
              j=i+1;
              $scope.Totalamt += response.data.Data[i].TotalPrice;
              $scope.Totalamtcoll += response.data.Data[i].AmoutCollect;
              $scope.Totalthird += response.data.Data[i].ThirdPartyCollection;
              $scope.Totaldel += response.data.Data[i].TotalDelivery;
              $scope.Totaldis += response.data.Data[i].TotalDistance;
              $("#displaydata").append(
                "<tr><td>" +
                j +
                "</td><td>" +
                response.data.Data[i].EmployeeName +
                "</td><td>" +
                response.data.Data[i].AmoutCollect +
                "</td><td>" +
                response.data.Data[i].ThirdPartyCollection +
                "</td><td>" +
                response.data.Data[i].TotalDelivery +
                "</td><td>" +
                response.data.Data[i].TotalDistance +
                "</td><td>" +
                response.data.Data[i].TotalPrice +
                "</td><td>" +
                '<a href="singleemp.php?id=' +
                response.data.Data[i]["_id"] +
                '"><button class="btn btn-primary" style="">View More</button></a>' +
                "</td></tr>"
              );
            }
            $scope.Totalamtcoll = $scope.Totalamtcoll;
            $scope.Totalthird = $scope.Totalthird;
            $scope.Totaldel = $scope.Totaldel;
            $scope.Totaldis = $scope.Totaldis;
            $scope.Totalamt = $scope.Totalamt;
            $scope.maxprice = response.data.MaxPriceCollectedBy.AmoutCollect;
            $scope.maxname = response.data.MaxPriceCollectedBy.EmployeeName;
          }
          else{
            $("#displaydata").html(
              "<tr><td colspan=6 class='text-center font-weight-bold'>" +
                data.Message +
                "</td></tr>"
            );
          }
          console.log($scope.Totalamt);
          }
        );
      };
      // $scope.getdata1();


        $(document).on("click", "#btn-search-date", function (e) {
          e.preventDefault();
          $scope.getdata1();
        });

      

    }
]);