myApplication.controller("AccountSetting", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.oldpassword = "";
        $scope.newpassword = "";
        $scope.accountname = sessionStorage.getItem("Name");
        $scope.btnsave = false;

        $scope.SaveAccountSettings = function() {
            let userId = sessionStorage.getItem("SessionId");
            let prepareData = {
                userId: userId,
                accountname: $scope.accountname,
                oldpassword: $scope.oldpassword,
                newpassword: $scope.newpassword,
            };
            $scope.btnsave = true;
            $http({
                url: BASE_URL + "admin/changePassword",
                method: "POST",
                cache: false,
                data: prepareData,
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data == 1 && response.data.IsSuccess === true) {
                        $scope.btnsave = false;
                        alert("Your Account Name & Password Updated Successfully!");
                        sessionStorage.clear();
                        window.location.href = "index.php";
                    } else {
                        $scope.btnsave = false;
                        alert("Invalid Old Password");
                        $scope.oldpassword = "";
                        $scope.newpassword = "";
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
    },
]);