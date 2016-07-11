//alert("app.js");
(function() {
  'use strict';
  //$route = Routing.generate('news_index');
  angular.module('bsuir-ecm', ['ngAnimate', 'ngAria', 'ngCookies', 'ngMessages', 'ngResource', 'ngRoute', 'ngSanitize', 'ngTouch']).config(function($routeProvider) {
    return $routeProvider.when('/', {
      templateUrl: 'DepartmentSiteDefaultBundle:Default:index',
      controller: 'MainPageCtrl'
    }).when('/news', {
      templateUrl: 'DepartmentSiteNewsBundle:News:index',
      controller: 'NewsCtrl'
    }).when('/news/:slug/show', {
      templateUrl: 'DepartmentSiteNewsBundle:News:show',
      controller: 'OneNewsCtrl'
    }).when('/advert', {
      templateUrl: 'DepartmentSiteAdvertBundle:Advert:index',
      controller: 'AnnouncementsCtrl'
    }).when('/advert/:slug/show', {
      templateUrl: 'DepartmentSiteAdvertBundle:Advert:show',
      controller: 'OneAdvertCtrl'
    }).when('/projects', {
      templateUrl: 'views/projects/project-list.html',
      controller: 'ProjectsCtrl'
    }).when('/projects/:projectId', {
      templateUrl: 'views/projects/project.slim',
      controller: 'ProjectsController'
    }).when('/page/:slug/show', {
      templateUrl: 'DepartmentSitePageBundle:Page:show',
      controller: 'PageCtrl'
    }).otherwise({
      redirectTo: '/'
    });
  });
  
  angular.module('bsuir-ecm').filter('pagination', function() {
    return function(input, start) {
      start = +start;
      return input.slice(start);
    };
  });
}).call(this);

//# sourceMappingURL=app.js.map
