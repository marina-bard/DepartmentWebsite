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
    $scope.comment_id = undefined;
    $scope.init = function(id) {
        alert(id);
        $scope.formData.commentId = id;
    }
    $scope.showTextview = function () {
        $scope.isSuccess = false;
    };
    $scope.processForm = function (projectId) {
        if($scope.formData.commentId == undefined) {
            $scope.formData.commentId = -1;
            alert('commentId: ' + $scope.formData.commentId)
        }

        $scope.formData.projectId = projectId;
        // $scope.formData.commentId = commentId;
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



