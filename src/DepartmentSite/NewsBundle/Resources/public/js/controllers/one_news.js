var data1 = [];
var news_index = 0;

(function() {
  'use strict';
  angular.module('bsuir-ecm').controller('OneNewsCtrl', function($scope, $http) {
      //data = data.replace(/\"/g, "\'");
      console.log(data);
      data = data.replace(/&amp;nbsp;/g, '').replace(/\r\n/g, "\\r\\n");

      $scope.news = JSON.parse(data.replace(/"/g, '\'\'').replace(/&quot;/g, '"'));

  });

  angular.module('bsuir-ecm').filter('toHTML', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }]).filter('dateFilter', function() {
      return function (dateTime) {
          if(dateTime == undefined)
              return;
          var t = dateTime.split(/[- :]/);
          return new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
      }
  });

}).call(this);


//# sourceMappingURL=one_news.js.map
