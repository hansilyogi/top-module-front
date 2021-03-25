myApplication.controller("ExtraKms", [
  "$scope",
  "$http",
  function ($scope, $http) {
    if (sessionStorage.getItem("SessionId") == null) {
      window.location.href = "index.php";
    }
    $scope.FullData = [];
    $scope.OrderDetails = [];
    $scope.orderdata = [];
    $scope.getDefaultKilometer = function () {
      $scope.loader = true;
      $scope.tabdata = false;
      $http({
        url: BASE_URL + "admin/getextrakms",
        method: "POST",
        cache: false,
        data: {},
        headers: { "Content-Type": "application/json; charset=UTF-8" },
      }).then(
        async function (response) {
          $scope.Kilometers = [];
          if (response.data.Data.length != 0) {
            $scope.FullData = response.data.Data;
            console.log($scope.FullData);
            $scope.loader = false;
            $scope.tabdata = true;
          } else {
            $scope.FullData = [];
            $scope.loader = false;
            $scope.tabdata = true;
          }
        },
        function (error) {
          console.log(error);
          $scope.loader = false;
          $scope.tabdata = true;
        }
      );
    };
    $scope.getDefaultKilometer();

    $scope.calcDistance = function (p1, p2) {
      return (
        google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000
      ).toFixed(2);
    };

    $scope.showOrders = (name) => {
      $scope.orderdata = [];
      for (let i = 0; i < $scope.FullData.length; i++) {
        if ($scope.FullData[i].name == name) {
          $scope.orderdata = $scope.FullData[i].orderdata;
        }
      }
      $("#orderModal").modal("toggle");
    };

    $scope.SearchData = () => {
      if ($scope.fromDate != undefined && $scope.toDate != undefined) {
        let preparedData = {
          fromDate: new Date(new Date($scope.fromDate).setHours(0, 0, 0)),
          toDate: new Date(new Date($scope.toDate).setHours(0, 0, 0)),
        };
        $scope.loader = true;
        $scope.tabdata = false;
        $http({
          url: BASE_URL + "admin/getextrakms",
          method: "POST",
          cache: false,
          data: preparedData,
          headers: { "Content-Type": "application/json; charset=UTF-8" },
        }).then(
          async function (response) {
            $scope.FullData = [];
            $scope.OrderDetails = [];
            $scope.orderdata = [];
            if (response.data.Data.length != 0) {
              $scope.FullData = response.data.Data;
              console.log($scope.FullData);
              $scope.loader = false;
              $scope.tabdata = true;
            } else {
              $scope.FullData = [];
              $scope.loader = false;
              $scope.tabdata = true;
            }
          },
          function (error) {
            console.log(error);
            $scope.loader = false;
            $scope.tabdata = true;
          }
        );
      }
    };
  },
]);
