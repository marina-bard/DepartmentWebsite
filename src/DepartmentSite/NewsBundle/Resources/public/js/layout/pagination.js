(function() {
  'use strict';
  var set;

  set = function(scope, list) {
    scope.listLength = list.length;
    scope.curPage = 0;
    scope.pageSize = 3;
    scope.numberOfPages = function() {
      return Math.ceil($scope.listLength / $scope.pageSize);
    };
    return scope.range = function(n) {
      return new Array(n);
    };
  };

  angular.module('bsuir-ecm').filter('pagination', function() {
    return function(input, start) {
      start = +start;
      return input.slice(start);
    };
  });

}).call(this);

//# sourceMappingURL=pagination.js.map
