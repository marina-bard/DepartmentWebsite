//alert("app.js");
(function() {
  'use strict';
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
    }).when('/gallery', {
      templateUrl: 'DepartmentSiteGalleryBundle:Gallery:index',
      controller: 'GalleryCtrl'
    }).when('/gallery/:id/show', {
      templateUrl: 'DepartmentSiteGalleryBundle:Gallery:show',
      controller: 'OneGalleryCtrl'
    }).otherwise({
      redirectTo: '/'
    });
  });
  
  
}).call(this);

//# sourceMappingURL=app.js.map
