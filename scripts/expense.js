myApplication.controller("Expense", [
    "$scope",
    "$http",
    function ($scope, $http) {
      if (sessionStorage.getItem("SessionId") == null) {
        window.location.href = "index.php";
      }
  
      $scope.expenseCategory = "";
      $scope.description = "";
      $scope.amount = "";
      $scope.paymentType = "";
      $scope.btnsave = false;
      $scope.bannerList = [];
      empList = [];
      $scope.route = BASE_URL;

    $scope.getcategory = function(){
        $http({
            url: BASE_URL + "admin/getAllExpenseCategory",
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
                $("#expenseCategory").append(
                  "<option value=" +
                    response.data.Data[i]._id +
                    ">" +
                    response.data.Data[i].name +
                    "</option>"
                );
              }
            },
            function (error) {
              console.log(error);
            }
        );
    };
    $scope.getcategory();
  
      $scope.saveExpense = function () {
        $scope.btnsave = true;
  
        $http({
          url: BASE_URL + "admin/addExpenseData",
          method: "POST",
          data: {
            "expenseCategory": $("#expenseCategory").val(),
            "description": $("#description").val(),
            "amount": $("#amount").val(),
            "paymentType": $("#paymentType").val(),
          },
        //   transformRequest: angular.identity,
        //   headers: { "Content-Type": undefined, "Process-Data": false },
        }).then(
          function (response) {
              console.log(response);
            if (response.data.IsSuccess == true) {
              $scope.btnsave = false;
              alert("Expense Saved!");
              $scope.getExpenses();
              $("#myModal").modal("toggle");
              $scope.paymentType = "";
              $scope.expenseCategory = "";
              $scope.amount = "";
              $scope.description = "";
            } else {
              $scope.btnsave = false;
              alert("Unable to Save Expense");
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
                $scope.getExpenses();
              }
            },
            function (error) {
              console.log(error);
            }
          );
        }
      };
  
      $scope.getExpenses = function () {
        $http({
          url: BASE_URL + "admin/getAllExpenseData",
          method: "POST",
          cache: false,
          data: {},
          headers: { "Content-Type": "application/json; charset=UTF-8" },
        }).then(
          function (response) {
              console.log(response);
            if (response.data.Data.length != 0) {
              $scope.expenseList = [];
              $scope.expenseList = response.data.Data;
            }
          },
          function (error) {
            console.log(error);
          }
        );
      };
      $scope.getExpenses();
  
      $scope.OpenModal = function () {
        $scope.expenseCategory = "";
        $scope.description = "";
        $scope.amount = "";
        $scope.paymentType = "";
        $("#myModal").modal("toggle");
      };
    },
  ]);
  