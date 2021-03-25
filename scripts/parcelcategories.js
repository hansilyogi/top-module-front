myApplication.controller("ParcelCategories", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.title = "";
        $scope.btnsave = false;
        $scope.bannerList = [];
        $scope.route = BASE_URL;
        $scope.id = "0";

        $scope.saveBanner = function() {
            $scope.btnsave = true;
            var preForm = new FormData();
            angular.forEach($scope.files, function(file) {
                preForm.append("image", file);
            });
            preForm.append("id", $scope.id);
            preForm.append("title", $scope.title);
            preForm.append('price', $scope.price);
            preForm.append('note', $scope.note);
            $http({
                url: BASE_URL + "admin/addcategories",
                method: "POST",
                data: preForm,
                transformRequest: angular.identity,
                headers: { "Content-Type": undefined, "Process-Data": false },
            }).then(
                function(response) {
                    console.log(response);
                    if (response.data.Data == 1) {
                        $scope.btnsave = false;
                        alert("Category Saved!");
                        $scope.getBanners();
                        $("#myModal").modal("toggle");
                        $scope.title = "";
                        $scope.files = "";
                    } else {
                        $scope.btnsave = false;
                        alert("Unable to Save Category");
                    }
                },
                function(error) {
                    console.log(error);
                    $scope.btnsave = false;
                }
            );
        };

        $scope.editData = function(data) {
            $("#myModal").modal("toggle");
            $scope.id = data._id;
            $scope.title = data.title;
            $scope.note = data.note;
            $scope.price = data.price;
        }

        $scope.deleteData = function(data) {
            let preData = { id: data };
            let result = confirm("Do you really want to delete?");
            if (result) {
                $http({
                    url: BASE_URL + "admin/deletecategory",
                    method: "POST",
                    cache: false,
                    data: preData,
                    headers: { "Content-Type": "application/json; charset=UTF-8" },
                }).then(
                    function(response) {
                        if (response.data.Data == 1) {
                            alert("Category Deleted");
                            $scope.bannerList = [];
                            $scope.getBanners();
                        }
                    },
                    function(error) {
                        console.log(error);
                    }
                );
            }
        };

        $scope.getBanners = function() {
            $http({
                url: BASE_URL + "admin/category",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data.length != 0) {
                        $scope.bannerList = [];
                        $scope.bannerList = response.data.Data;
                    }
                },
                function(error) {
                    console.log(error);
                }
            );
        };
        $scope.getBanners();

        $scope.OpenModal = function() {
            $scope.title = "";
            $scope.id = "0";
            angular.element("input[type='file']").val(null);
            $("#myModal").modal("toggle");
        };
    },
]);