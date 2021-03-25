myApplication.controller("PromoCode", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.modaltitle = "Add New Promo Code";
        $scope.imgurl = IMGBASE_URL;
        $scope.title;
        $scope.description;
        $scope.code;
        $scope.discount;
        $scope.validfrom;
        $scope.validupto;
        $scope.PromocodeList = [];
        $scope.isForNewUser;
        $scope.status;
        $scope.Id = 0;
        $scope.savePromocode = function() {
            var preForm = new FormData();
            angular.forEach($scope.files, function(file) {
                preForm.append("image", file);
            });
            preForm.append("id", $scope.Id);
            preForm.append("title", $scope.title);
            preForm.append("description", $scope.description);
            preForm.append("code", $scope.code);
            preForm.append("discount", Number($scope.discount));
            preForm.append("validfrom", $scope.validfrom);
            preForm.append("validupto", $scope.validupto);
            preForm.append('status',$scope.status);
            preForm.append('isForNewUser',"");

            $http({
                url: "http://3.7.176.96/" + "admin/addpromocode",
                method: "POST",
                data: preForm,
                transformRequest: angular.identity,
                headers: { "Content-Type": undefined, "Process-Data": false },
            }).then(
                function(response) {
                    console.log(response);
                    if (response.data.Data == 1) {
                        $scope.getPromocode();
                        $scope.ClearData();
                        $('#myModal').modal("toggle");
                        alert("Promo code saved!");
                    } else {
                        alert("Unable to save promocode!");
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };

        $scope.deletePromocode = function(id) {
            let ids = id;
            var prepareData = { id: ids };

            let result = confirm("Do You Really Want To Delete?");
            if (result) {
                $http({
                    url: "http://3.7.176.96/" + "admin/deletepromocode",
                    method: "POST",
                    cache: false,
                    data: prepareData,
                    headers: { "Content-Type": "application/json; charset=UTF-8" },
                }).then(
                    function(response) {
                        if (response.data.Data == 1) {
                            $scope.getPromocode();
                            $scope.ClearData();
                            alert("Promo code deleted!");
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
            $scope.modaltitle = "Edit Promo Code";
            $('#myModal').modal("toggle");
            $scope.Id = data._id;
            $scope.title = data.title;
            $scope.description = data.description;
            $scope.code = data.code;
            $scope.discount = data.discount;
            $scope.isForNewUser = data.isForNewUser;
            $scope.validfrom = new Date(data.validfrom);
            $scope.validupto = new Date(data.validupto);
            if( $scope.isForNewUser == true){
                $scope.status = 0;
            } else {
                $scope.status = 1;
            }
            console.log($scope.status);
        }

        $scope.getPromocode = function() {
            $http({
                url: "http://3.7.176.96/" + "admin/adminProcodes",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data.length != 0) {
                        $scope.PromocodeList = response.data.Data;
                    } else {}
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.getPromocode();

        $scope.OpenModal = function(){
            $scope.modaltitle = "Add New Promo Code";
            $scope.ClearData();
            $('#myModal').modal("toggle");
        }

        $scope.ClearData = function(data) {
            $scope.Id = 0;
            $scope.title = "";
            $scope.description = "";
            $scope.code = "";
            $scope.discount = "";
            $scope.validfrom = "";
            $scope.validupto = "";
            angular.element("input[type='file']").val(null);
        }
    },
]);