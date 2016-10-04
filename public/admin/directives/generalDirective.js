angular.module('learnPubApp').directive("checkboxM", function() {
  return {
    require: 'ngModel',
    priority: 10000,
    restrict: 'EA',
    link: function($scope, element, attributes, ngModelController) {
        ngModelController.$parsers.push(function(data) {
          //convert data from view format to model format
          return (data == true) ? "1" : "0";
        });

        ngModelController.$formatters.push(function(data) {
          //convert data from model format to view format
          return (data == "1") ? true : false;
        });
    }
  };
});

angular.module('learnPubApp').directive("slugurlM", ['$parse',function($parse) {
  return {
    scope: true,
    restrict: 'A',
    scope: {
      slugurlM: '@slugurlM',
      ngModel: '='
    },
    // template: "{{slugurlM}}",
    link: function($scope, element, attributes, ngModelController) {

      function slugify(text)
      {
        if (typeof text === 'undefined' || typeof text != "string") {
          return "";
        } else {
          return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
        }
      };

      $scope.$parent.$watch(attributes.slugurlM, function(newVal, oldVal){
        $parse(attributes.ngModel).assign($scope.$parent, slugify(newVal));
      });

    }
  };
}]);
