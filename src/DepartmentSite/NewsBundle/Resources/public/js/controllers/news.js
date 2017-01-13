'use strict';
var data = [];
var news_length;
angular.module('bsuir-ecm').controller('NewsCtrl', function($scope){
  $scope.news = JSON.parse(data.replace(/"/g, '\'\'').replace(/&quot;/g, '"'));
  console.log($scope.news);
});


