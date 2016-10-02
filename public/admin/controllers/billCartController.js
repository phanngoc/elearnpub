angular.module('learnPubApp').filter('typeItem', ['$sce', function($sce) {
  return function(param) {
    if (param == "1") {
      return $sce.trustAsHtml("<p>Book</p>");
    } else if (param == "2") {
      return $sce.trustAsHtml("<p>Bundle</p>");
    }
  };
}]);

angular.module('learnPubApp').controller('billCartController', function($scope, $state, $stateParams, BillService) {

  BillService.getCartsBelongBill($stateParams.id).then(function(response) {
    if (response.data.status == true) {
      $scope.carts = response.data.result;
    }
  });

  $scope.pageItem = function(itemId, type) {
    if (type == "1") {
      $state.go('admin.book', {id : itemId});
    } else if (type == "2") {
      $state.go('admin.bundle', {id : itemId});
    }
  }
});
