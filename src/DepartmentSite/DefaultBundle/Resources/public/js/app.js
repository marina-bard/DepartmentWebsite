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
      controller: 'NoticesCtrl'
    }).when('/notice/:slug/show', {
      templateUrl: 'DepartmentSiteNoticeBundle:Notice:show',
      controller: 'OneNoticeCtrl'
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
      controller: 'CommentsCtrl'
    }).when('/comment/new', {
      templateUrl: 'DepartmentSiteProjectBundle:Comment:new',
       controller: 'OneProjectCtrl'
    }).when('/comment/:id/show', {
      templateUrl: 'DepartmentSiteProjectBundle:Comment:show',
       controller: 'OneProjectCtrl'
    }).when('/comment/:id/edit', {
      templateUrl: 'DepartmentSiteProjectBundle:Comment:edit',
      controller: 'OneProjectCtrl'
    }).when('/register', {
      templateUrl: 'ApplicationFOSUserBundle:RegistrationUser:register',
      controller: 'RegisterCtrl'
    }).when('/profile', {
      templateUrl: 'ApplicationFOSUserBundle:Profile:show',
      controller: 'EditProfileCtrl'
    }).otherwise({
      redirectTo: '/'
    });
  });
  
  
}).call(this);

//# sourceMappingURL=app.js.map
