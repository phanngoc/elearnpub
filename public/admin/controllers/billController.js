angular.module('learnPubApp').controller('billController', function($scope, $state, $stateParams, BillService) {
  $scope.bills = [];

  $scope.currentPage = 1;

  $scope.totalItems = 10;

  $scope.pageChanged = function() {
    BillService.fetchBills($scope.currentPage).then(function(response) {
      if (response.data.status == true) {
        $scope.bills = response.data.result.items;
        $scope.currentPage = response.data.result.currentPage;
        $scope.totalItems = response.data.result.total;
      }
    });
  }

  BillService.fetchBills($scope.currentPage).then(function(response) {
    if (response.data.status == true) {
      $scope.bills = response.data.result.items;
      $scope.currentPage = response.data.result.currentPage;
      $scope.totalItems = response.data.result.total;
    }
  });

  $scope.goCart = function(id) {
    $state.go("admin.bills.carts", {id : id});
  }
});

angular.module('learnPubApp').controller('chartMonthController', function($scope, $state, $stateParams, BillService) {
  $scope.chartMonth = {};

  $scope.chartMonth.startMonth = moment().subtract(5, "months").toDate();
  $scope.chartMonth.endMonth = moment().toDate();

  BillService.chartMonth($scope.chartMonth).then(function(response) {
    if (response.data.status == true) {
      var monthRange = _.map(response.data.result, function(item) { return item.date; });
      var countRange = _.map(response.data.result, function(item) { return item.num; });

      $scope.labels = monthRange;
      $scope.series = ["Amount of bill"];
      $scope.data = [countRange];
    }
  });

  $scope.updateChart = function() {
    BillService.chartMonth($scope.chartMonth).then(function(response) {
      if (response.data.status == true) {
        var monthRange = _.map(response.data.result, function(item) { return item.date; });
        var countRange = _.map(response.data.result, function(item) { return item.num; });

        $scope.labels = monthRange;
        $scope.series = ["Amount of bill"];
        $scope.data = [countRange];
      }
    });
  }
});

angular.module('learnPubApp').config(['ChartJsProvider', function (ChartJsProvider) {
  'use strict';
  ChartJsProvider.setOptions({
    tooltips: { enabled: false }
  });
}]);

angular.module('learnPubApp').controller('chartTopSellController', function($scope, $state, $stateParams, BillService) {

  var start = moment().subtract(29, 'days');
  var end = moment();

  $('input[name="daterange"]').daterangepicker({
    startDate: start,
    endDate: end,
    locale: {
      format: 'YYYY-MM-DD'
    },
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  },function(start, end, label) {
    $scope.mdaterange = start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD');
    $scope.eventUpdateChart();
  });

  // $scope.mdaterange = start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD');

  $scope.mdaterange = '2015-08-30 - ' + end.format('YYYY-MM-DD');

  $scope.options = {
            scales: {
                xAxes: [{
                  display: true,
                  ticks: {
                    max: 20,
                    min: -20,
                    stepSize: 5
                  }
                }],
                yAxes: [{
                  display: true,
                  ticks: {
                    max: 20,
                    min: -20,
                    stepSize: 5
                  }
                }]
              },
          };

  $scope.randomScalingFactor = function() {
    return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 20);
  }

  $scope.updateData = function(data) {

    $scope.series = _.map(data, function(item) { return item.title; });
    $scope.labels = $scope.series;
    $scope.data = [];
    $scope.itemChoose = {};

    _.each(data, function(item) {
        $scope.data.push([{
          x: $scope.randomScalingFactor(),
          y: $scope.randomScalingFactor(),
          r: item.num_item * 4,
          item: item
        }]);
    });
  }

  BillService.topSell($scope.mdaterange).then(function(response) {
    if (response.data.status == true) {
      $scope.updateData(response.data.result);
    }
  });

  $scope.getItemGeometry = function(point, event) {
    var mouseX = event.offsetX;
    var mouseY = event.offsetY;

    var itemChoose = _.find(point, function(item) {
      var x = item._model.x;
      var y = item._model.y;
      var r = item._model.radius;
      var distance = Math.sqrt(Math.pow((x-mouseX),2) + Math.pow((y-mouseY),2));
      return distance <= r;
    });
    return itemChoose;
  }

  $scope.clickBubble = function(point, event) {
    if (typeof point != "undefined" && point != null && point.length > 0) {
      var chartElem = $scope.getItemGeometry(point, event);
      $scope.itemChoose = $scope.data[chartElem._datasetIndex][0].item;
      $scope.$apply();

      if ($scope.itemChoose.type == "1") {
        $state.go('admin.books.detail', {id: $scope.itemChoose.item_id});
      } else {
        $state.go('admin.bundle', {id: $scope.itemChoose.item_id});
      }

    }
  }

  $scope.hoverBubble = function(point, event) {
    if (typeof point != "undefined" && point != null && point.length > 0) {
      var chartElem = $scope.getItemGeometry(point, event);
      $scope.itemChoose = $scope.data[chartElem._datasetIndex][0].item;
      $scope.$apply();
    }
  }

  $scope.eventUpdateChart = function() {
    BillService.topSell($scope.mdaterange).then(function(response) {
      if (response.data.status == true) {
        $scope.updateData(response.data.result);
      }
    });
  }

});
