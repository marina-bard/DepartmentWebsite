'use strict';
var data = [];
var news_length;

(function() {
  angular.module('bsuir-ecm').controller('NewsCtrl', function($scope) {
      $scope.news = JSON.parse(data.replace(/"/g, '\'\'').replace(/&quot;/g, '"'));
  });
}).call(this);


