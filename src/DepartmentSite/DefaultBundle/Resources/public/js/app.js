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
    }).when('/notice', {
      templateUrl: 'DepartmentSiteNoticeBundle:Notice:index',
      controller: 'AnnouncementsCtrl'
    }).when('/notice/:slug/show', {
      templateUrl: 'DepartmentSiteNoticeBundle:Notice:show',
      controller: 'OneAdvertCtrl'
    }).when('/page/:slug/show', {
      templateUrl: 'DepartmentSitePageBundle:Page:show',
      controller: 'PageCtrl'
    }).when('/gallery', {
      templateUrl: 'DepartmentSiteGalleryBundle:Gallery:index',
      controller: 'GalleryCtrl'
    }).when('/gallery/:id/show', {
      templateUrl: 'DepartmentSiteGalleryBundle:Gallery:show',
      controller: 'OneGalleryCtrl'
    }).when('/project/', {
      templateUrl: 'DepartmentSiteProjectBundle:Project:index',
      controller: 'ProjectsCtrl'
    }).when('/project/:slug/show', {
      templateUrl: 'DepartmentSiteProjectBundle:Project:show',
      // controller: 'OneProjectCtrl'
    }).otherwise({
      redirectTo: '/'
    });
  });
  
  
}).call(this);

//# sourceMappingURL=app.js.map
