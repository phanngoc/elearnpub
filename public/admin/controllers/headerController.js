

angular.module('learnPubApp').controller('headerController', ['$scope', '$state',
                        '$stateParams', 'BundleService', 'principal', '$http', function($scope, $state,
                        $stateParams, BundleService, principal, $http) {

      $scope.email = "";

      $scope.avatar = "";

      $scope.id = "";

      principal.identity()
                  .then(function(identity) {
                    $scope.email = identity.email;
                    $scope.avatar = identity.avatar;
                    $scope.id = identity.id;
                  });

      $scope.signOut = function() {
        $http.get(BASE_URL + '/admin/account/logout').then(function(response) {
          if (response.data.result == true) {
              principal.authenticate(null);
              $state.go('signin');
          }
        });
      }
}]);
