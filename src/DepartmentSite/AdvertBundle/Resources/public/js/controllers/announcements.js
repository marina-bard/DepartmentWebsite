(function() {
  'use strict';
  angular.module('bsuir-ecm').controller('AnnouncementsCtrl', function($scope) {
    $scope.curPage = 0;
    $scope.pageSize = 3;
    $scope.numberOfPages = function() {
      return Math.ceil($scope.news.length / $scope.pageSize);
    };
    $scope.range = function(n) {
      return new Array(n);
    };
    return $scope.announcements = JSON.parse(data);
  });
  
}).call(this);

//# sourceMappingURL=announcements.js.map
