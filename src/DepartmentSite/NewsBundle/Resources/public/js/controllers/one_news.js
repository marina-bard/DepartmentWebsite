var data1 = [];
var news_index = 0;

(function() {
  'use strict';
  angular.module('bsuir-ecm').controller('OneNewsCtrl', function($scope, $http) {
      data = data.replace(/\"/g, "\'");
      data = data.replace(/\\/g, "\"");
      console.log(data);
      $scope.news = JSON.parse(data);

  });

  angular.module('bsuir-ecm').filter('toHTML', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }]);

}).call(this);


function getNewsIndex(id) {
    for(var i = 0; i < data.length; i += 1) {
         if(data[i].id == id) {
             console.log(data[i].id);
             return i;
         }
       }
  };
//# sourceMappingURL=one_news.js.map
