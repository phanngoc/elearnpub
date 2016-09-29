angular.module('learnPubApp').service('PackageService', function ($http) {

  this.find = function(packageId) {
    return $http.get(BASE_URL + '/admin/package/' + packageId);
  };

  this.update = function(package) {
    var data = {
      id : package.id,
      title : package.name,
      minimumprice : package.minimumprice,
      suggestedprice : package.suggestedprice,
      quantity : package.quantity,
      url : package.url,
      _token : TOKEN
    }
    return $http.post(BASE_URL + '/admin/package/' + package.id, data);
  };

});
