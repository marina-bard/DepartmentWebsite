'use strict';

var data = [];
var news_index = 0;

(function() {
  angular.module('bsuir-ecm').controller('OneNoticeCtrl', function($scope, $http) {
      data = data.replace(/&amp;nbsp;/g, '').replace(/\r\n/g, "\\r\\n");
      $scope.news = JSON.parse(data.replace(/"/g, '\'\'').replace(/&quot;/g, '"'));
  });

  angular.module('bsuir-ecm').filter('toHTML', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }]);

}).call(this);