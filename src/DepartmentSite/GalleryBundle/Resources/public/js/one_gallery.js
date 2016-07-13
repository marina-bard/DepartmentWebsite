var gallery = [];

(function() {
    'use strict';
    angular.module('bsuir-ecm').controller('OneGalleryCtrl', function($scope, $http) {
        $scope.photos = JSON.parse(gallery.replace(/&quot;/g, '"'));
    });

}).call(this);