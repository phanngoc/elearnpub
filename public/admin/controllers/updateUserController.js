angular.module('learnPubApp').controller('updateUserController', function($scope, $state, UserService, UploadFileService, $stateParams, ngProgressFactory, Notification) {

  $scope.user = {};

  $scope.roles = {};

  $scope.progressbar = ngProgressFactory.createInstance();

  UserService.findOne($stateParams.id).then(function(response) {
    if (response.data.status == true) {
      $scope.user = response.data.result;
    }
  });

  UserService.fetchRoles($stateParams.id).then(function(response) {
    if (response.data.status == true) {
      $scope.roles = response.data.result;
    }
  });

  $scope.uploadAvatarFile = function (event) {
     console.log("uploadAvatarFile");
     var files = event.target.files;
     var extension = files[0].name.split('.').pop();
     var newName = "temp" + UploadFileService.ID() + '.' + extension;

     $scope.user.avatar = newName;

     UploadFileService.uploadFile(files, [newName]).then(function(response) {
         if (response.data.status == "true") {
             Notification.success("Upload successfully");
         }
     });
  };

  $scope.submit = function() {
    if ($scope.updateUser.$valid) {
      $scope.progressbar.start();
      UserService.updateUser($stateParams.id, $scope.user).then(function(response) {
        if (response.data.status == true) {
          Notification.success('Success notification');
          $scope.progressbar.complete();
        }
      });
		}
  }
});
