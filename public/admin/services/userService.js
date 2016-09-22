angular.module('learnPubApp').service('UserService', function ($http) {
    this.fetchUsers = function(page) {
        var pageNum = typeof page !== 'undefined' ? page : 1;
        return $http.get(BASE_URL + '/admin/user/list?page=' + pageNum);
    };
    this.findOne = function(id) {
        return $http.get(BASE_URL + '/admin/user/edit/' + id);
    };
    this.fetchRoles = function() {
        return $http.get(BASE_URL + '/admin/role/list');
    };
    this.updateUser = function(id, user) {
        var url = BASE_URL + "/admin/user/update/" + id;
        return $http.post(url, user);
    };
});
