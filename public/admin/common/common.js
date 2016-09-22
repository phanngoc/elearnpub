'use strict'
angular.module('learnPubApp').config(['$stateProvider', function($stateProvider) {

    $stateProvider
          .state('admin', {
              abstract: true,
              views: {
                  'main': {
                      templateUrl: '/public/views/main.html'
                  }
              }
          });
}]);
