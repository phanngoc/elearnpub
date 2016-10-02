
angular.module('learnPubApp').controller('listBookController', function($scope, $state, BookService, Notification) {

  $scope.books = [];

  $scope.currentPage = 1;

  $scope.totalItems = 10;

  $scope.pageChanged = function() {
    BookService.fetchBooks($scope.currentPage).then(function(response) {
      if (response.data.status == true) {
        $scope.books = _.map(response.data.result.items, function(item){
              item.allow_published = (item.allow_published == "1") ? true : false;
              return item;
        });

        $scope.currentPage = response.data.result.currentPage;
        $scope.totalItems = response.data.result.total;
      }
    });
  }

  BookService.fetchBooks($scope.currentPage).then(function(response) {
    if (response.data.status == true) {
      $scope.books = _.map(response.data.result.items, function(item){
            item.allow_published = (item.allow_published == "1") ? true : false;
            return item;
      });

      $scope.currentPage = response.data.result.currentPage;
      $scope.totalItems = response.data.result.total;
    }
  });

  $scope.allowPublishBook = function(bookId, isAllowed) {
    BookService.changePublishBook(bookId, isAllowed).then(function(response){
      if (response.data.status == true) {
        Notification.success("Update successfully");
      }
    });
  }

  $scope.pageBundle = function(bookId) {
    $state.go("admin.books.bundle", {id : bookId});
  }

  $scope.editBook = function(bookId) {
    $state.go("admin.books.detail", {id : bookId});
  }

});
