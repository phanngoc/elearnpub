angular.module('learnPubApp').service('BillService', function ($http) {

  this.fetchBills = function(page) {
      var pageNum = typeof page !== 'undefined' ? page : 1;
      return $http.get(BASE_URL + '/admin/bill/list?page=' + pageNum);
  };

  this.getCartsBelongBill = function(billId) {
      return $http.get(BASE_URL + '/admin/bill/' + billId + '/cart');
  };

  this.chartMonth = function($params) {
      var data = {start_month: moment($params.startMonth).format('YYYY-MM-DD'), end_month: moment($params.endMonth).format('YYYY-MM-DD')};
      var config = {
              params: data
          };
      return $http.get(BASE_URL + '/admin/bill/chart-by-month', config);
  };

  this.topSell = function(dateRange) {
      var date = dateRange.split(" - ");
      var data = {start: date[0], end: date[1], limit: 10};
      var config = {
              params: data
          };
      return $http.get(BASE_URL + '/admin/bill/chart-top-seller', config);
  };
});
