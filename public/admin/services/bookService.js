angular.module('learnPubApp').service('UserService', function ($http) {
    this.fetchBooks = function(page) {
        var pageNum = typeof page !== 'undefined' ? page : 1;
        return $http.get(BASE_URL + '/admin/book/list?page=' + pageNum);
    };
});
