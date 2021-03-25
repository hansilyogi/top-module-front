//Local Connection
 //var IMGBASE_URL = "http://localhost:3000/";
 //var BASE_URL = "http://localhost:3000/";

var IMGBASE_URL = "http://3.7.176.96/";
// var BASE_URL = "https://pick-and-delivery.herokuapp.com/";
// var BASE_URL = "http://3.7.176.96/";
// var BASE_URL = "http://13.126.231.240/";
var BASE_URL = "http://localhost:3000/";
var BASE_URL_2 = "http://13.126.231.240/";
var BASE_URL_3 = "http://3.7.176.96/";
var myApplication = angular.module("AppModule", [
    "datatables",
    "ui.bootstrap",
    "ui.utils",
]);

myApplication.directive("fileInput", function($parse) {
    return {
        link: function($scope, element, attrs) {
            element.on("change", function(event) {
                var files = event.target.files;
                $parse(attrs.fileInput).assign($scope, element[0].files);
                $scope.$apply();
            });
        }
    }
});