myApplication.controller("Customers", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.customerList = [];
        $scope.MessageList = [];
        $scope.modalData = [];
        $scope.route = BASE_URL;
        $scope.loader = false;
        $scope.tabdata = true;
        $scope.messagebox = "";
        $scope.selectmessageBox;
        $scope.mobileno = "";

        $scope.customersCounter = function() {
            $http({
                url: BASE_URL + "admin/getallCustomer",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    console.log(response);
                    if (response.data.Data.length != 0) {
                        $scope.customerList = response.data.Data;
                        $scope.loader = true;
                        $scope.tabdata = false;
                    } else {
                        $scope.loader = true;
                        $scope.tabdata = false;
                        console.log("Opps! customers Found.");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.customersCounter();

        $scope.getMessages = function() {
            $http({
                url: BASE_URL + "admin/messages",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    console.log(response);
                    if (response.data.Data.length != 0) {
                        $scope.MessageList = [];
                        $scope.MessageList = response.data.Data;
                        console.log($scope.MessageList);
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        // $scope.getMessages();

        $scope.changeMessagebox = function() {
            $scope.messagebox = "";
            let id = $scope.selectmessageBox;
            for (let i = 0; i < $scope.MessageList.length; i++) {
                if ($scope.MessageList[i]._id == id) {
                    $scope.messagebox = $scope.MessageList[i].description;
                }
            }
        }

        $scope.sendWAMessage = function() {
            let message = $scope.messagebox;
            let mobile = $scope.mobileno;
            let createWALink = "https://web.whatsapp.com/send?phone=91" + mobile + "&text=" + message;
            window.open(createWALink, '_blank');
        }


        $scope.ShowData = function(mobile) {
            $scope.selectmessageBox = "";
            // $scope.messagebox = "";
            $scope.mobileno = mobile;
            $("#myModal").modal("toggle");
        };

        $scope.DeleteData = function(id) {
            var result = confirm("Do you really want to delete this customer?");
            if (result) {
                $http({
                    url: BASE_URL + "admin/customersDelete",
                    method: "POST",
                    cache: false,
                    data: { id: id },
                    headers: { "Content-Type": "application/json; charset=UTF-8" },
                }).then(
                    function(response) {
                        if (response.data.Data == 1) {
                            $scope.customersCounter();
                        } else {
                            console.log("Opps! Unable to Delete");
                        }
                    },
                    function(error) {
                        console.log(error);
                    }
                );
            }
        };
    },
]);