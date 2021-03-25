myApplication.controller("Banners", [
  "$scope",
  "$http",
  function ($scope, $http) {
    if (sessionStorage.getItem("SessionId") == null) {
      window.location.href = "index.php";
    }

    $scope.title = "";
    $scope.type = "";
    $scope.btnsave = false;
    $scope.bannerList = [];
    $scope.route = BASE_URL;

    $scope.saveBanner = function () {
      $scope.btnsave = true;
      var preForm = new FormData();
      angular.forEach($scope.files, function (file) {
        preForm.append("image", file);
      });
      preForm.append("title", $scope.title);
      preForm.append("type", $scope.type);

      $http({
        url: BASE_URL + "admin/addbanner",
        method: "POST",
        data: preForm,
        transformRequest: angular.identity,
        headers: { "Content-Type": undefined, "Process-Data": false },
      }).then(
        function (response) {
          if (response.data.Data == 1) {
            $scope.btnsave = false;
            alert("Banner Saved!");
            $scope.getBanners();
            $("#myModal").modal("toggle");
            $scope.title = "";
            $scope.files = "";
            $scope.type = "";
          } else {
            $scope.btnsave = false;
            alert("Unable to Save Banner");
          }
        },
        function (error) {
          console.log(error);
          $scope.btnsave = false;
        }
      );
    };

    $scope.deleteData = function (data) {
      let preData = { id: data };
      let result = confirm("Do you really want to delete?");
      if (result) {
        $http({
          url: BASE_URL + "admin/deletebanner",
          method: "POST",
          cache: false,
          data: preData,
          headers: { "Content-Type": "application/json; charset=UTF-8" },
        }).then(
          function (response) {
            if (response.data.Data == 1) {
              alert("Banner Deleted");
              $scope.bannerList = [];
              $scope.getBanners();
            }
          },
          function (error) {
            console.log(error);
          }
        );
      }
    };

    $scope.getBanners = function () {
      $http({
        url: BASE_URL + "admin/banners",
        method: "POST",
        cache: false,
        data: {},
        headers: { "Content-Type": "application/json; charset=UTF-8" },
      }).then(
        function (response) {
          if (response.data.Data.length != 0) {
            $scope.bannerList = [];
            $scope.bannerList = response.data.Data;
          }
        },
        function (error) {
          console.log(error);
        }
      );
    };
    $scope.getBanners();

    $scope.OpenModal = function () {
      $scope.title = "";
      $scope.type = "";
      angular.element("input[type='file']").val(null);
      $("#myModal").modal("toggle");
    };
  },
]);
