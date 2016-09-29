
angular.module('learnPubApp').controller('packageController', function($scope, $state,
                        $stateParams, PackageService, Notification, $sce) {

  PackageService.find($stateParams.id).then(function(response) {
    if (response.data.status == true) {
      $scope.package = response.data.result;
      $scope.package.minimumprice = parseInt($scope.package.minimumprice);
      $scope.package.suggestedprice = parseInt($scope.package.suggestedprice);
      $scope.package.quantity = parseInt($scope.package.quantity);
    }
  });

  $scope.updatePackage = function() {
    console.log("updatePackage");
    PackageService.update($scope.package).then(function(response) {
      if (response.data.status == true) {
        Notification.success("Update successfully");
      }
    });
  }
});
