'use strict'

var BASE_URL = 'http://localhost/elearnpub/public';
var App = angular.module('learnPubApp', ['ui.router', 'ngMaterial', 'ui.bootstrap',
                        'ngProgress', 'ui-notification', 'ngMessages', 'chart.js']);

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

App.config(function ($mdThemingProvider) {
  // $mdThemingProvider
  //   .theme('default')
  //   .primaryPalette('indigo')
  //   .accentPalette('pink')
  //   .warnPalette('red')
  //   .backgroundPalette('indigo');
});

App.factory('principal', ['$q', '$http', '$timeout',
  function($q, $http, $timeout) {
    var _identity = undefined,
        _authenticated = false;

    return {
      isIdentityResolved: function() {
        return angular.isDefined(_identity);
      },

      isAuthenticated: function() {
        return _authenticated;
      },

      isInRole: function(role) {
        if (!_authenticated || !_identity.roles) return false;

        return _identity.roles.indexOf(role) != -1;
      },

      isInAnyRole: function(roles) {
        if (!_authenticated || !_identity.roles) return false;

        for (var i = 0; i < roles.length; i++) {
          if (this.isInRole(roles[i])) return true;
        }

        return false;
      },

      authenticate: function(identity) {
        _identity = identity;
        _authenticated = identity != null;

        // for this demo, we'll store the identity in localStorage. For you, it could be a cookie, sessionStorage, whatever
        if (identity) {
          localStorage.setItem("user.admin.identity", angular.toJson(identity));
        } else {
          localStorage.removeItem("user.admin.identity");
        }
      },

      identity: function(force) {
        var deferred = $q.defer();

        if (force === true) _identity = undefined;

        // check and see if we have retrieved the identity data from the server. if we have, reuse it by immediately resolving
        if (angular.isDefined(_identity) || _identity === null) {
          deferred.resolve(_identity);
          return deferred.promise;
        }

        // otherwise, retrieve the identity data from the server, update the identity object, and then resolve.
        $http.get(BASE_URL + '/admin/account/identity', { ignoreErrors: true })
             .success(function(response) {
                if (response.status == true) {
                  _identity = response.result;
                  _authenticated = true;
                  deferred.resolve(_identity);
                } else {
                  _identity = null;
                  _authenticated = false;
                  deferred.resolve(_identity);
                }
             });

        return deferred.promise;
      }
    };
  }
])

.factory('authorization', ['$rootScope', '$state', 'principal',
  function($rootScope, $state, principal) {
    return {
      authorize: function() {
        return principal.identity()
          .then(function() {
              var isAuthenticated = principal.isAuthenticated();
              // user is not authenticated. stow the state they wanted before you
              // send them to the signin state, so you can return them when you're done
              if (!isAuthenticated) {
                $rootScope.returnToState = $rootScope.toState;
                $rootScope.returnToStateParams = $rootScope.toStateParams;

                // now, send them to the signin state so they can log in
                $state.go('signin');
              }
          });
      },
      logout: function() {

      }
    };
  }
])

App.config(['$httpProvider', '$urlRouterProvider', function($httpProvider, $urlRouterProvider){

    $httpProvider.defaults.withCredentials = true;

    $urlRouterProvider.when('', '/home');
}])

.run(function($rootScope, ngProgressFactory, $timeout) {
  $rootScope.progressbar = ngProgressFactory.createInstance();
  $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams, options) {
      $rootScope.progressbar.start();
  });
  $rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams) {
      $rootScope.progressbar.complete();
  });
});
