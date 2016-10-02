angular.module('learnPubApp').controller('loginController', ['$scope', '$state', '$http', 'principal',
                                            function($scope, $state, $http, principal){

  $scope.email = "";
  $scope.password = "";

  $scope.loginForm = function() {
    $http.post(BASE_URL + '/admin/account/login', {email: $scope.email, password: $scope.password, _token: TOKEN})
         .success(function(response) {
           if (response.status == true) {
             principal.authenticate(response.result);
             $state.go('admin');
           }
         })
         .error(function () {
           console.log($scope.loginFormName.email.$error);
           $scope.loginFormName.email.$error.wrongUsernamePassword = true;
         });
  }
}]);
