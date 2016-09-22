
angular.module('learnPubApp').controller('listBookController', function($scope, $state, BookService){

  $scope.books = [];

  $scope.currentPage = 1;

  $scope.totalItems = 10;

  $scope.pageChanged = function() {
    BookService.fetchBooks($scope.currentPage).then(function(response) {
      if (response.data.status == true) {
        $scope.books = response.data.result.items;
        $scope.currentPage = response.data.result.currentPage;
        $scope.totalItems = response.data.result.total;
      }
    });
  }

  BookService.fetchBooks($scope.currentPage).then(function(response) {
    if (response.data.status == true) {
      $scope.books = response.data.result.items;
      $scope.currentPage = response.data.result.currentPage;
      $scope.totalItems = response.data.result.total;
    }
  });

});
