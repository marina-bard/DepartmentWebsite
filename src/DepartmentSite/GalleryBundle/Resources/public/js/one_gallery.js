'use strict';

var gallery = [];

angular.module('bsuir-ecm').controller('OneGalleryCtrl', function($scope, $http) {
    $scope.photos = JSON.parse(gallery.replace(/"/g, '\'\'').replace(/&quot;/g, '"'));
});
