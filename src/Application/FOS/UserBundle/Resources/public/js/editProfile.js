'use strict';
var userInfo = {};
angular.module('bsuir-ecm').controller('EditProfileCtrl', function($scope, $http){
    $scope.formData = JSON.parse(userInfo);
    
    console.log($scope.formData);
    $scope.isSuccess = false;
    $scope.url = "";

    $scope.processForm = function () {
        $http({
            method  : 'POST',
            url     : $scope.url,
            data    : $.param($scope.formData),
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
            .success(function(data) {
                $scope.isSuccess = true;
                $scope.message = data;
                console.log(data);
            }).error(function (data) {
            console.log(data.errors);
        });
    }
});






