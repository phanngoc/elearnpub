angular.module('learnPubApp').filter('avatarImage', function() {
    return function(name) {
      var linkReal = BASE_URL + '/uploads/' + name;
      return linkReal;
    };
});

angular.module('learnPubApp').filter('labelYesNo', ['$sce', function($sce) {
   return function(param) {
       if (param == "1") {
         return $sce.trustAsHtml("<span class='label label-success'>Yes</span>");
       } else {
         return $sce.trustAsHtml("<span class='label label-danger'>No</span>");
       }
   };
}]);
