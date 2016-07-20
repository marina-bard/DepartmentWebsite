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


}).call(this);

