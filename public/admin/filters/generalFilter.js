angular.module('learnPubApp').filter('avatarImage', function() {
    return function(name) {
      var linkReal = BASE_URL + '/uploads/' + name;
      return linkReal;
    };
});
