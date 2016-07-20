var adverts_list = [];
var news_list = [];
var projects_list = [];

(function() {
  'use strict';
  angular.module('bsuir-ecm').controller('MainPageCtrl', function($scope) {

    $scope.adverts = JSON.parse(adverts_list.replace(/&quot;/g, '"'));
    $scope.news = JSON.parse(news_list.replace(/&quot;/g, '"'));
    $scope.projects = JSON.parse(projects_list.replace(/&quot;/g, '"'));

    return $scope.adverts;

  }).filter('dateFilter', function() {
    return function (dateTime) {
      if(dateTime == undefined)
          return;
      var t = dateTime.split(/[- :]/);
      return new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
    }
  });


}).call(this);
