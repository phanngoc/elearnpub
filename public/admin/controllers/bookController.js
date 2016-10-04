

angular.module('learnPubApp').controller('bookController', function($scope, $state, $stateParams,
            BookService, Notification, $interval) {

  BookService.findBook($stateParams.id).then(function(response) {
    if (response.data.status == true) {
      $scope.book = response.data.result;
    }
  });

  $scope.updateBook = function() {
    BookService.updateBook($stateParams.id, $scope.book).then(function(response) {
      if (response.data.status == true) {
        Notification.success("Update successfully");
      }
    });
  }
});
