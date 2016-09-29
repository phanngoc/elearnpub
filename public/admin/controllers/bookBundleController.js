
angular.module('learnPubApp').controller('bookBundleController', function($scope, $state, $stateParams, $sce) {

  if ($stateParams.book === null) {
    $scope.book = JSON.parse(localStorage.getItem("book"));
  } else {
    $scope.book = $stateParams.book;
    localStorage.setItem("book", JSON.stringify($scope.book));
  }

  $scope.pageToBundle = function(bundleId) {
    $state.go("admin.bundle", {id : bundleId});
  }

});
