var adverts_list = [];
var news_list = [];

(function() {
  'use strict';
  angular.module('bsuir-ecm').controller('MainPageCtrl', function($scope) {

    $scope.adverts = JSON.parse(adverts_list.replace(/&quot;/g, '"'));
    $scope.news = JSON.parse(news_list.replace(/&quot;/g, '"'));

    return $scope.adverts;

  });

}).call(this);
