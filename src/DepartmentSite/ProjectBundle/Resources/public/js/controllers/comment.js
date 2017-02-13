'use strict';
var project_comments = [];
var comments_count;

angular.module('bsuir-ecm').controller('CommentsCtrl', function($scope, $http){
    $scope.formData = {};
    $scope.isSuccess = false;
    $scope.comments = JSON.parse(project_comments.replace(/"/g, '\'\'').replace(/&quot;/g, '"'));
    $scope.comments_count = $scope.comments.length;
    $scope.comment_id = undefined;
    $scope.url = "";

    $scope.init = function(id) {
        if(id){
            $scope.formData.commentId = id;
        }
        else return false;
    };

    $scope.showTextview = function () {
        $scope.isSuccess = false;
    };

    $scope.processForm = function (projectId) {
        if($scope.formData.commentId == undefined) {
            $scope.formData.commentId = -1;
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
        }).error(function (data) {
        });
    }
});



