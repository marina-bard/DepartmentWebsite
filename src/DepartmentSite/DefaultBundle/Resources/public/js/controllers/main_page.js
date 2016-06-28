var adverts_list = [];
var news_list = [];

(function() {
  'use strict';
  angular.module('bsuir-ecm').controller('MainPageCtrl', function($scope) {

    adverts_list = adverts_list.replace(/\"/g, "\'");
    adverts_list = adverts_list.replace(/\\/g, "\"");
    console.log(adverts_list);
    adverts_list = JSON.parse(adverts_list);
    
    $scope.adverts = adverts_list;

    news_list = news_list.replace(/\"/g, "\'");
    news_list = news_list.replace(/\\/g, "\"");
    console.log(news_list);
    news_list = JSON.parse(news_list);


    $scope.news = news_list;

    $scope.adverts = adverts_list;
    $scope.news = news_list;
    return $scope.adverts;

  });

}).call(this);
