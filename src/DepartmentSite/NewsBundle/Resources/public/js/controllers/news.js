var data = [];
var news_length;

(function() {
  'use strict';
  angular.module('bsuir-ecm').factory('PagerService', PagerService).controller('NewsCtrl', function($scope, PagerService){

    // $scope.news = JSON.parse(data.replace(/&quot;/g, '"'));
    $scope.news = JSON.parse(data);
    console.log($scope.news);

    $scope.pageSize = 10;

    $scope.pager = {};
    $scope.setPage = setPage;

    $scope.numberOfPages = function() {
      return Math.ceil(news_length / $scope.pageSize);
    };
    
    function setPage(page) {
      if (page < 1 || page > $scope.numberOfPages()) {
        return;
      }

      $scope.pager = PagerService.GetPager(news_length, page);
      return page;
    }

    $scope.hasNext = function () {
      if ($scope.pager.currentPage < $scope.numberOfPages()) {
        return true;
      }
      else {
        return false;
      }
    }

    $scope.hasPrevious = function () {
      if ($scope.pager.currentPage-1 > 0) {
        return true;
      }
      else {
        return false;
      }
    }
  }).filter('dateFilter', function() {
    return function (dateTime) {
      
      if(dateTime == undefined)
        return;
      var t = dateTime.split(/[- :]/);
      return new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
    }
  });

  function PagerService() {

    var service = {};
    var itemsPerPage = 10;
    service.GetPager = GetPager;
    return service;

    function myRange(start, stop, step) {
      if (stop == null) {
        stop = start || 0;
        start = 0;
      }
      step = step || 1;

      var length = Math.max(Math.ceil((stop - start) / step), 0);
      var range = Array(length);

      for (var idx = 0; idx < length; idx++, start += step) {
        range[idx] = start;
      }

      return range;
    };

    function GetPager(totalItems, currentPage, pageSize) {

      currentPage = currentPage || 1;
      pageSize = pageSize || itemsPerPage;

      var totalPages = Math.ceil(totalItems / pageSize);

      var startPage, endPage;
      if (totalPages <= 5) {
        startPage = 1;
        endPage = totalPages;
      } else {
        if (currentPage <= 3) {
          startPage = 1;
          endPage = 5;
        } else if (currentPage + 2 >= totalPages) {
          startPage = totalPages - 4;
          endPage = totalPages;
        } else {
          startPage = currentPage - 2;
          endPage = currentPage + 2;
        }
      }

      var startIndex = (currentPage - 1) * pageSize;
      var endIndex = startIndex + pageSize;

      var pages = myRange(startPage, endPage + 1, 1);

      return {
        totalItems: totalItems,
        currentPage: currentPage,
        pageSize: pageSize,
        totalPages: totalPages,
        startPage: startPage,
        endPage: endPage,
        startIndex: startIndex,
        endIndex: endIndex,
        pages: pages
      };
    }
  }

}).call(this);


