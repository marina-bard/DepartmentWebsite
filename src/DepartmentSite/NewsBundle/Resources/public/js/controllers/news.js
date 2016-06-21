var data = [];

//alert("JS controller");
(function() {
  'use strict';
  angular.module('bsuir-ecm').controller('NewsCtrl', function($scope, $http) {
    $scope.curPage = 0;
    $scope.pageSize = 3;
    $scope.numberOfPages = function() {
      return Math.ceil($scope.news.length / $scope.pageSize);
    };
    $scope.range = function(n) {
      return new Array(n);
    };
    //console.log(data);
    data = JSON.parse(data);

    $scope.news = data;
  });

  angular.module('bsuir-ecm').filter('pagination', function() {
    return function(input, start) {
      start = +start;
      return input.slice(start);
    };
  });

}).call(this);


//# sourceMappingURL=news.js.map
