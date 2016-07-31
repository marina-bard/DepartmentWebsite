'use strict';

angular.module('bsuir-ecm').controller('RegisterCtrl', function($scope, $http){
    $scope.formData = {};
    $scope.needChange = needChange;

    $scope.showTextview = function () {
        $scope.isSuccess = false;
    };
    $scope.processForm = function () {
        $http({
            method  : 'POST',
            url     : 'http://localhost:8000/register/new',
            data    : $.param($scope.formData),
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
            .success(function(data) {
                $scope.message = data;
                console.log(data);

                // if (!data.success) {
                //     // if not successful, bind errors to error variables
                //     $scope.errorName = data.errors;
                //     $scope.errorSuperhero = data.errors.superheroAlias;
                // } else {
                //     // if successful, bind success message to message
                //     $scope.message = data.message;
                // }
            }).error(function (data) {
            console.log(data.errors);
        });
    }
}).filter('toHTML', ['$sce', function($sce){
    return function(text) {
        return $sce.trustAsHtml(text);
    };
}]);






