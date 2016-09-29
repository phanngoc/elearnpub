angular.module('learnPubApp').service('BundleService', function ($http) {
  this.find = function(bundleId) {
    return $http.get(BASE_URL + '/admin/bundle/' + bundleId);
  };

  this.update = function(bundle) {
    var data = {
      id : bundle.id,
      title : bundle.title,
      description : bundle.description,
      minimum : bundle.minimum,
      is_published : bundle.is_published,
      _token : TOKEN
    }
    return $http.post(BASE_URL + '/admin/bundle/' + bundle.id, data);
  };

});
