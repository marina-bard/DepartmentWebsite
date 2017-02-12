'use strict';
var data = [];

(function() {
    angular.module('bsuir-ecm').controller('ProjectsCtrl', function($scope){
        data = data.replace(/"/g, '\'\'').replace(/&quot;/g, '"').replace(/&amp;nbsp;/g, " ").replace(/\r\n/g, "\\r\\n");
        $scope.projects = JSON.parse(data);

    }).filter('dateFilter', function() {
        return function (dateTime) {
            if(dateTime === undefined)
                return;
            var t = dateTime.split(/[- :]/);
            return new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
        }
    });
}).call(this);
