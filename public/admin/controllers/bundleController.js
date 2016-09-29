

angular.module('learnPubApp').controller('bundleController', function($scope, $state,
                        $stateParams, BundleService, Notification, $sce) {

  BundleService.find($stateParams.id).then(function(response) {
    if (response.data.status == true) {
      $scope.bundle = response.data.result;
      $scope.bundle.minimum = parseInt($scope.bundle.minimum);
      $scope.bundle.is_published = ($scope.bundle.is_published == "1") ? true : false;
    }
  });

  $scope.updateBundle = function() {
    console.log("updateBundle");
    BundleService.update($scope.bundle).then(function(response) {
      if (response.data.status == true) {
        Notification.success("Update successfully");
      }
    });
  }
});
