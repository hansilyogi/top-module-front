myApplication.controller("Login", [
  "$scope",
  "$http",
  function ($scope, $http) {
    if (sessionStorage.getItem("SessionId") != null) {
      window.location.href = "dashboard.php";
    }
    $scope.mobileNo = "";
    $scope.password = "";
    $scope.errmsg = "Login to start your session";
    $scope.errstyle = { color: "grey" };
    $scope.loader = false;
    $scope.errscr = true;
    $scope.btndis = false;

    $scope.loginSystem = function () {
      var data = {
        mobileNo: $scope.mobileNo,
        password: $scope.password,
      };
      $scope.loader = true;
      $scope.errscr = false;
      $scope.btndis = true;
      $http({
        url: BASE_URL + "admin/login",
        method: "POST",
        cache: false,
        data: data,
        headers: { "Content-Type": "application/json; charset=UTF-8" },
      }).then(
        function (response) {
          // console.log(response);
          if(response.data.Data.length != 0){
            sessionStorage.setItem("SessionId",response.data.Data[0]._id);
            sessionStorage.setItem("name",response.data.Data[0].name);
            window.location.href = "dashboard.php";
          }
          else{
            alert("Enter proper Credentials");
            location.reload();
          }
        },
        function (error) {
          $scope.errstyle = { color: "red" };
          $scope.errmsg = "Interval Server Error!";
          $scope.loader = false;
          $scope.errscr = true;
          $scope.btndis = false;
        }
      );
    };
  },
]);
