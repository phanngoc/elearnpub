
angular.module('learnPubApp').controller('listUserController', function($scope, $state, UserService){

  $scope.users = [];

  $scope.currentPage = 1;

  $scope.totalItems = 10;

  $scope.pageChanged = function() {
    UserService.fetchUsers($scope.currentPage).then(function(response) {
      if (response.data.status == true) {
        $scope.users = response.data.result.items;
        $scope.currentPage = response.data.result.currentPage;
        $scope.totalItems = response.data.result.total;
      }
    });
  }

  UserService.fetchUsers($scope.currentPage).then(function(response) {
    if (response.data.status == true) {
      $scope.users = response.data.result.items;
      $scope.currentPage = response.data.result.currentPage;
      $scope.totalItems = response.data.result.total;
    }
  });

  $scope.editUser = function(id) {
    $state.go("admin.users.update", {id : id});
  }
});
