var BASE_URL = "https://shrouded-savannah-05270.herokuapp.com/";
var myApplication = angular.module("myApp", []);
myApplication.controller("Statistics", [
  "$scope",
  "$http",
  function ($scope, $http) {
    $scope.currentUrl = window.location.href;
    $scope.url = new URL($scope.currentUrl);

    $scope.StatisticsList = [];
    $scope.totalOrder = 0;
    $scope.totalExtraKm = 0;

    $scope.getStatistics = function () {
      $("#myModal").modal("toggle");
      let dataid = $scope.url.searchParams.get("courierId");
      $http({
        url: BASE_URL + "admin/appstatistics",
        method: "POST",
        cache: false,
        data: { courierId: dataid },
        headers: { "Content-Type": "application/json; charset=UTF-8" },
      }).then(
        function (response) {
          if (response.data.Data.length != 0) {
            $scope.totalOrder = response.data.Data.length;
            for (let i = 0; i < response.data.Data.length; i++) {
              $scope.totalExtraKm =
                $scope.totalExtraKm + Number(response.data.Data[i].extaKM);
            }
            $scope.StatisticsList = response.data.Data;
            $("#myModal").modal("toggle");
          } else {
            $scope.StatisticsList = [];
            console.log("Nothing Found!");
            $("#myModal").modal("toggle");
          }
        },
        function (error) {
          console.log(error);
          $("#myModal").modal("toggle");
        }
      );
    };
    $scope.getStatistics();
  },
]);
