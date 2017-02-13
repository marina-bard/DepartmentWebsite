'use strict';

angular.module('bsuir-ecm').controller('RegisterCtrl', function($scope, $http){
    $scope.formData = {};
    $scope.url = "";
    // $scope.needChange = needChange;

    $scope.showTextview = function () {
        $scope.isSuccess = false;
    };
    $scope.processForm = function () {
        $http({
            method  : 'POST',
            url     : $scope.url,
            data    : $.param($scope.formData),
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
        })
            .success(function(data) {
                $scope.message = data;
            }).error(function (data) {
        });
    }
}).filter('toHTML', ['$sce', function($sce){
    return function(text) {
        return $sce.trustAsHtml(text);
    };
}]);






