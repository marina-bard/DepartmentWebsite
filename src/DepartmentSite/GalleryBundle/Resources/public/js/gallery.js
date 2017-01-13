'use strict';
angular.module('bsuir-ecm').controller('GalleryCtrl', function($scope) {
    $scope.galleries = JSON.parse(data.replace(/"/g, '\'\'').replace(/&quot;/g, '"'));
});

