myApplication.controller("AppSetting", [
    "$scope",
    "$http",
    function($scope, $http) {
        if (sessionStorage.getItem("SessionId") == null) {
            window.location.href = "index.php";
        }

        $scope.loader = true;
        $scope.formView = false;
        $scope.btnupdate = false;
        $scope.perunder5km = 0;
        $scope.perkm = 0;
        $scope.referalpoint = 0;
        $scope.whatsAppNo = "";
        $scope.DefaultWMessage = "";
        $scope.AppLink = "";
        $scope.AmountPayKM = 0;
        $scope.FromTime ;
        $scope.ToTime ;
        $scope.handling_charges = 0.0;
        $scope.AdminMObile1 = "9825226141";
        $scope.AdminMObile2 = "9879208321";
        $scope.AdminMObile3 = "8200682175";
        $scope.AdminMObile4 = "7778874008";
        $scope.AdminMObile5 = "9898376899";
        $scope.NewUserprice ;
        $scope.NewUserUnderKm ;
        $scope.addKmCharge ;
        $scope.additionalKm ;
        $scope.addKmCharge2 ;
        $scope.additionalKm2 ;
        $scope.newpromocode ;
        $scope.GetPricesettings = function() {
            $http({
                url: BASE_URL + "admin/settings",
                method: "POST",
                cache: false,
                data: {},
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data.length == 1) {
                        $scope.perunder5km = response.data.Data[0].PerUnder5KM;
                        $scope.perkm = response.data.Data[0].PerKM;
                        $scope.referalpoint = response.data.Data[0].ReferalPoint;
                        $scope.whatsAppNo = response.data.Data[0].WhatsAppNo;
                        $scope.DefaultWMessage = response.data.Data[0].DefaultWMessage;
                        $scope.AppLink = response.data.Data[0].AppLink;
                        $scope.AmountPayKM = response.data.Data[0].AmountPayKM;
                        $scope.FromTime = response.data.Data[0].FromTime;
                        $scope.ToTime = response.data.Data[0].ToTime;
                        $scope.handling_charges = response.data.Data[0].handling_charges;
                        $scope.AdminMObile1 = response.data.Data[0].AdminMObile1;
                        $scope.AdminMObile2 = response.data.Data[0].AdminMObile2;
                        $scope.AdminMObile3 = response.data.Data[0].AdminMObile3;
                        $scope.AdminMObile4 = response.data.Data[0].AdminMObile4;
                        $scope.AdminMObile5 = response.data.Data[0].AdminMObile5;
                        $scope.NewUserprice = response.data.Data[0].NewUserprice;
                        $scope.NewUserUnderKm = response.data.Data[0].NewUserUnderKm;
                        $scope.additionalKm = response.data.Data[0].additionalKm;
                        $scope.addKmCharge  = response.data.Data[0].addKmCharge;
                        $scope.additionalKm2 = response.data.Data[0].additionalKm2;
                        $scope.addKmCharge2  = response.data.Data[0].addKmCharge2;
                        $scope.newpromocode = response.data.Data[0].newpromocode;
                        $scope.loader = false;
                        $scope.formView = true;
                        console.log(response);
                    } else {
                        console.log("Opps! Price Settings Not Available.");
                        $scope.loader = false;
                        $scope.formView = true;
                    }
                },
                function(error) {
                    console.log("Opps! Something Went Wrong.");
                    $scope.loader = false;
                    $scope.formView = true;
                }
            );
        };
        $scope.GetPricesettings();

        $scope.savePriceSettings = function() {
            $scope.loader = true;
            $scope.btnupdate = true;
            var jsonData = {
                PerUnder5KM: $scope.perunder5km,
                PerKM: $scope.perkm,
                ReferalPoint: $scope.referalpoint,
                WhatsAppNo: $scope.whatsAppNo,
                DefaultWMessage: $scope.DefaultWMessage,
                AppLink: $scope.AppLink,
                AmountPayKM:$scope.AmountPayKM,
                handling_charges:$scope.handling_charges,
                FromTime:$scope.FromTime,
                ToTime:$scope.ToTime,
                AdminMObile1:$scope.AdminMObile1,
                AdminMObile2:$scope.AdminMObile2,
                AdminMObile3:$scope.AdminMObile3,
                AdminMObile4:$scope.AdminMObile4,
                AdminMObile5:$scope.AdminMObile5,
                NewUserprice : $scope.NewUserprice,
                NewUserUnderKm : $scope.NewUserUnderKm,
                additionalKm : $scope.additionalKm,
                addKmCharge : $scope.addKmCharge,
                additionalKm2 : $scope.additionalKm2,
                addKmCharge2 : $scope.addKmCharge2,
                newpromocode : $scope.newpromocode,
            };
            $http({
                url: BASE_URL + "admin/updatesetttings",
                method: "POST",
                cache: false,
                data: jsonData,
                headers: { "Content-Type": "application/json; charset=UTF-8" },
            }).then(
                function(response) {
                    if (response.data.Data == 1) {
                        $scope.GetPricesettings();
                        $scope.btnupdate = false;
                        $scope.loader = false;
                    } else {
                        console.log("Opps! Unable to Update Price Settings.");
                        $scope.btnupdate = false;
                        $scope.loader = false;
                    }
                },
                function(error) {
                    console.log("Opps! Something Went Wrong.");
                    $scope.btnupdate = false;
                    $scope.loader = false;
                }
            );
        };
    },
]);