angular.module('learnPubApp').controller('bookPackageController', function($scope, $state, $stateParams, $sce) {

  if ($stateParams.book === null) {
    $scope.book = JSON.parse(localStorage.getItem("book"));
  } else {
    $scope.book = $stateParams.book;
    localStorage.setItem("book", JSON.stringify($scope.book));
  }

  $scope.pageToPackage = function(packageId) {
    $state.go("admin.package", {id : packageId});
  }

});
