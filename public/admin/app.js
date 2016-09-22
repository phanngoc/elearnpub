'use strict'

var BASE_URL = 'http://localhost/elearnpub/public';
var App = angular.module('learnPubApp', ['ui.router', 'ngMaterial', 'ui.bootstrap', 'ngProgress', 'ui-notification', 'ngMessages']);

App.config(function(NotificationProvider) {
    NotificationProvider.setOptions({
        delay: 10000,
        startTop: 20,
        startRight: 10,
        verticalSpacing: 20,
        horizontalSpacing: 20,
        positionX: 'left',
        positionY: 'bottom'
    });
});

App.config(['$httpProvider', '$urlRouterProvider', function($httpProvider, $urlRouterProvider){

    $httpProvider.defaults.withCredentials = true;

    $urlRouterProvider.when('', '/');

}])

.run(function($rootScope) {

});
