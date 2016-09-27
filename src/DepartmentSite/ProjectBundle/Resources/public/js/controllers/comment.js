'use strict';
var project_comments = [];
var comments_count;

angular.module('bsuir-ecm').controller('CommentsCtrl', function($scope, $http){
    $scope.formData = {};
    $scope.isSuccess = false;
    $scope.comments = JSON.parse(project_comments.replace(/"/g, '\'\'').replace(/&quot;/g, '"'));
    console.log($scope.comments);
    $scope.comments_count = comments_count;
    $scope.comment_id = undefined;
    $scope.url = "";

    $scope.init = function(id) {
        if(id){
            // alert(id);
            $scope.formData.commentId = id;
        }
        else return;
    };

    $scope.showTextview = function () {
        $scope.isSuccess = false;
    };

    $scope.processForm = function (projectId) {
        if($scope.formData.commentId == undefined) {
            $scope.formData.commentId = -1;
            // alert('commentId: ' + $scope.formData.commentId)
        }
        $scope.formData.projectId = projectId;
        $http({
            method  : 'POST',
            url     : $scope.url,
            data    : $.param($scope.formData), 
            headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
        })
        .success(function(data) {
            $scope.message = data;
            $scope.formData = null;
            $scope.isSuccess = true;
            console.log(data);
        }).error(function (data) {
            console.log(data.errors);
        });
    }
});



