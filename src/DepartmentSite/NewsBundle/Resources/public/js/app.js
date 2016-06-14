//alert("app.js");
(function() {
  'use strict';
  //$route = Routing.generate('news_index');
  angular.module('bsuir-ecm', ['ngAnimate', 'ngAria', 'ngCookies', 'ngMessages', 'ngResource', 'ngRoute', 'ngSanitize', 'ngTouch']).config(function($routeProvider) {
    return $routeProvider.when('/', {
      templateUrl: 'views/main.html',
      controller: 'MainCtrl'
    }).when('/news', {
      templateUrl: 'DepartmentSiteNewsBundle:News:index',
      controller: 'NewsCtrl'
    }).when('/news/:id/show', {
      templateUrl: 'DepartmentSiteNewsBundle:News:show',
      //controller: 'NewsCtrl'
      controller: 'OneNewsCtrl'
    }).when('/projects', {
      templateUrl: 'views/projects/project-list.html',
      controller: 'ProjectsCtrl'
    }).when('/projects/:projectId', {
      templateUrl: 'views/projects/project.slim',
      controller: 'ProjectsController'
    }).otherwise({
      redirectTo: '/'
    });
  });
}).call(this);

//# sourceMappingURL=app.js.map
