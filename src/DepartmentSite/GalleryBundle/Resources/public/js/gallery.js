(function() {
    'use strict';
    angular.module('bsuir-ecm').controller('GalleryCtrl', function($scope, $http) {});

    angular.module('bsuir-ecm').filter('range', function() {
        return function(input, total) {
            var i;
            total = parseInt(total);
            i = 0;
            while (i < total) {
                input.push(i);
                i++;
            }
            return input;
        };
    });

}).call(this);
/**
 * Created by artvlad96 on 13.07.16.
 */
