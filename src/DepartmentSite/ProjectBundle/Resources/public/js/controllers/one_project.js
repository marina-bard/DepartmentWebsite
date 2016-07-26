'use strict';
var data = [];
var project_comments = [];

(function() {
    angular.module('bsuir-ecm').controller('OneProjectCtrl', function($scope){
        data = data.replace(/&quot;/g, '"').replace(/&amp;/g, '&').replace(/&;nbsp;/g, " ").replace(/\r\n/g, "\\r\\n");
        console.log(data);
        console.log(data[408]);
        // $scope.project = JSON.parse(data);
    }).filter('dateFilter', function() {
        return function (dateTime) {
            if(dateTime == undefined)
                return;
            var t = dateTime.split(/[- :]/);
            return new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
        }
    }).filter('toHTML', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }]);
}).call(this);

