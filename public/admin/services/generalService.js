angular.module('learnPubApp').service('UploadFileService', function ($http) {

    return {
        uploadFile: function (files, renames) {

            var fd = new FormData();

            for (var i=0; i < files.length; i++){
                fd.append('files[]', files[i]);
                fd.append('newNames[]', renames[i]);
            }

            return $http.post(BASE_URL + '/admin/uploads', fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            })
        },

        showPreview : function (input, selector) {

            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function (e) {
                    $(selector).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        },

        ID : function () {
            // Math.random should be unique because of its seeding algorithm.
            // Convert it to base 36 (numbers + letters), and grab the first 9 characters
            // after the decimal.
            return '_' + Math.random().toString(36).substr(2, 9);
        }
    }
});

angular.module('learnPubApp').directive('customOnChange', function() {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var onChangeHandler = scope.$eval(attrs.customOnChange);
            element.bind('change', onChangeHandler);
        }
    };
});
