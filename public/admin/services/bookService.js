angular.module('learnPubApp').service('BookService', function ($http) {
  this.fetchBooks = function(page) {
      var pageNum = typeof page !== 'undefined' ? page : 1;
      return $http.get(BASE_URL + '/admin/book/list?page=' + pageNum);
  };
  this.changePublishBook = function(bookId, isAllowed) {
    var data = {
      book_id : bookId,
      is_allowed : isAllowed,
      _token : TOKEN
    };
    return $http.post(BASE_URL + '/admin/book/publish', data);
  };
});
