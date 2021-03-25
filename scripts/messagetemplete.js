myApplication.controller("Message", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.OpenModal = function() {
            $("#myModal").modal("toggle");
        };

        $scope.datalist = [];
        $scope.Id = 0;
        $scope.description = "";
        $scope.title = "";

        $scope.getMessages = function() {
            $http({
                url: BASE_URL + "admin/messages",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data.length != 0) {
                        $scope.datalist = [];
                        $scope.datalist = response.data.Data;
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.getMessages();

        $scope.savetemplete = function() {
            let prepareData = {
                id: $scope.Id,
                title: $scope.title,
                description: $scope.description,
            };
            $http({
                url: BASE_URL + "admin/addMessage",
                method: "POST",
                cache: false,
                data: prepareData,
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data == 1) {
                        $scope.getMessages();
                        $scope.ClearData();
                        $("#myModal").modal("toggle");
                        alert("Message Saved!");
                    } else {
                        alert("Unable to Save Message!");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };

        $scope.deleteTemplete = function(id) {
            let ids = id;
            var prepareData = { id: ids };

            let result = confirm("Do You Really Want To Delete?");
            if (result) {
                $http({
                    url: BASE_URL + "admin/deleteMessage",
                    method: "POST",
                    cache: false,
                    data: prepareData,
                    headers: { "Content-Type": "application/json; charset=UTF-8" },
                }).then(
                    function(response) {
                        console.log(response.data);
                        if (response.data.Data == 1) {
                            $scope.datalist = [];
                            $scope.getMessages();
                            $scope.ClearData();
                        } else {
                            alert("Unable to delete promocode!");
                        }
                    },
                    function(error) {
                        console.log(error);
                    }
                );
            }
        };

        $scope.editData = function(data) {
            $("#myModal").modal("toggle");
            $scope.Id = data._id;
            $scope.title = data.title;
            $scope.description = data.description;
        };

        $scope.ClearData = function() {
            $scope.Id = 0;
            $scope.title = "";
            $scope.description = "";
        };
    },
]);