'use strict';

var data = [];
var news_index = 0;

angular.module('bsuir-ecm').controller('OneNoticeCtrl', function($scope, $http) {
  // data = data.replace(/\"/g, "\'");
  // data = data.replace(/\\/g, "\"");
  // console.log(data);
  // $scope.advert = JSON.parse(data);
});

angular.module('bsuir-ecm').filter('toHTML', ['$sce', function($sce){
    return function(text) {
        return $sce.trustAsHtml(text);
    };
}]);
