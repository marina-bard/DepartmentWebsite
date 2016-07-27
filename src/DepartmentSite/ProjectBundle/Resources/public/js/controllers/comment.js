'use strict';
var project_comments = {};
var comments_count;
var needChange = false;

angular.module('bsuir-ecm').controller('CommentsCtrl', function($scope, $http, $compile){
    $scope.formData = {};
    $scope.isSuccess = false;
    $scope.comments = JSON.parse(project_comments.replace(/&quot;/g, '"'));
    $scope.comments_count = comments_count;
    $scope.needChange = needChange;

    $scope.showTextview = function () {
        $scope.isSuccess = false;
    };
    $scope.processForm = function (projectId) {
        $scope.formData.projectId = projectId;
        $http({
            method  : 'POST',
            url     : 'http://localhost:8000/ru/comment/new',
            data    : $.param($scope.formData), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        })
        .success(function(data) {
            $scope.message = data;
            $scope.formData = null;
            $scope.isSuccess = true;
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
});



