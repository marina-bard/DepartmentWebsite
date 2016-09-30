(function() {
    'use strict';
    angular.module('bsuir-ecm').controller('GalleryCtrl', function($scope, $http) {
        $scope.galleries = JSON.parse(data.replace(/"/g, '\'\'').replace(/&quot;/g, '"'));
    });
}).call(this);

