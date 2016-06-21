(function() {
  'use strict';
  angular.module('bsuir-ecm').controller('ProjectsCtrl', function($scope) {
    var setPagination;
    setPagination = function($scope, list) {
      $scope.listLength = list.length;
      $scope.curPage = 0;
      $scope.pageSize = 3;
      $scope.numberOfPages = function() {
        return Math.ceil($scope.listLength / $scope.pageSize);
      };
      return $scope.range = function(n) {
        return new Array(n);
      };
    };
    $scope.posts = [
      {
        "title": "Интеллектуальные вычислительные комплексы, системы и компьютерные сети",
        "author": "Канаш Владислав Николаевич",
        "course": 3,
        "group": 350501
      }, {
        "title": "Гульня калгасау begins! 1",
        "author": "Влад Канаш",
        "course": 3,
        "group": 350501
      }, {
        "title": "Гульня калгасау begins! 2",
        "author": "Влад Канаш",
        "course": 3,
        "group": 350501
      }, {
        "title": "Гульня калгасау begins! 3",
        "author": "Влад Канаш",
        "course": 3,
        "group": 350501
      }, {
        "title": "Гульня калгасау begins! 4",
        "author": "Влад Канаш",
        "course": 3,
        "group": 350501
      }, {
        "title": "Гульня калгасау begins! 5",
        "author": "Влад Канаш",
        "course": 3,
        "group": 350501
      }, {
        "title": "Гульня калгасау begins! 6",
        "author": "Влад Канаш",
        "course": 3,
        "group": 350501
      }, {
        "title": "Гульня калгасау begins! 7",
        "author": "Влад Канаш",
        "course": 3,
        "group": 350501
      }
    ];
    return setPagination($scope, $scope.posts);
  });

  angular.module('bsuir-ecm').filter('pagination', function() {
    return function(input, start) {
      start = +start;
      return input.slice(start);
    };
  });

}).call(this);

//# sourceMappingURL=projects.js.map
