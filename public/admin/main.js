'use strict'
angular.module('learnPubApp').config(['$stateProvider', function($stateProvider){

    $stateProvider
         .state('masterAdmin', {
             abstract: true,
             views: {
                 'main': {
                     templateUrl: BASE_URL + '/admin/views/main.html'
                 }
             }
         })
        .state('admin', {
            parent: 'masterAdmin',
            url: '/home',
            views: {
                'header': {
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
                'content': {
                    templateUrl: BASE_URL + '/admin/views/home.html'
                },
                'footer': {
                    templateUrl: BASE_URL + '/admin/views/partial/footer.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                }
            }
        })
        .state('admin.users', {
            parent: 'masterAdmin',
            url: '/users/list',
            views: {
                'content': {
                    controller: 'listUserController',
                    templateUrl: BASE_URL + '/admin/views/users/list.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                }
            }
        })
        .state('admin.users.create', {
            parent: 'masterAdmin',
            url: '/users/create',
            views: {
                'content': {
                    controller: 'createUserController',
                    templateUrl: '/public/admin/views/users/create.html'
                }
            }
        })
        .state('admin.users.update', {
            parent: 'masterAdmin',
            url: '/users/update/:id',
            views: {
                'content': {
                    controller: 'updateUserController',
                    templateUrl: BASE_URL + '/admin/views/users/update.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                }
            }
        })
}]);
