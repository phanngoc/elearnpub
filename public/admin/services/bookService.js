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

  this.findBook = function(bookId) {
    return $http.get(BASE_URL + '/admin/book/' + bookId);
  };

  this.updateBook = function(bookId, book) {
    var data = {
      'title': book.title,
      'subtitle': book.subtitle,
      'teaser': book.teaser,
      'description': book.description,
      'thankyoumessage': book.thankyoumessage,
      'bookurl': book.bookurl,
      'language_id': book.language_id,
      'google_analytic': book.google_analytic,
      'is_published': book.is_published,
      'is_publish_sample': book.is_publish_sample,
      'allow_published': book.allow_published
    };

    return $http.post(BASE_URL + '/admin/book/' + bookId, data);
  }
});
