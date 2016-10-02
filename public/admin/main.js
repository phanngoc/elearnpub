'use strict'
angular.module('learnPubApp').config(['$stateProvider', function($stateProvider){

    $stateProvider
          .state('signin', {
              views: {
                  'main': {
                      controller: 'loginController',
                      templateUrl: BASE_URL + '/admin/views/login.html'
                  }
              }
          })
         .state('masterAdmin', {
             abstract: true,
             resolve: {
                authorize: ['authorization',
                  function(authorization) {
                    return authorization.authorize();
                  }
                ]
             },
             views: {
                 'main': {
                     templateUrl: BASE_URL + '/admin/views/main.html'
                 },
             }
         })
        .state('admin', {
            parent: 'masterAdmin',
            url: '/home',
            views: {
                'header': {
                    controller: 'headerController',
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
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
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
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
            }
        })
        .state('admin.books', {
            parent: 'masterAdmin',
            url: '/books/list',
            views: {
                'content': {
                    controller: 'listBookController',
                    templateUrl: BASE_URL + '/admin/views/books/list.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
            }
        })
        .state('admin.books.detail', {
            parent: 'masterAdmin',
            url: '/book/:id',
            views: {
                'content': {
                    controller: 'bookController',
                    templateUrl: BASE_URL + '/admin/views/books/book.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
            }
        })
        .state('admin.bundle', {
            parent: 'masterAdmin',
            url: '/bundle/:id',
            views: {
                'content': {
                    controller: 'bundleController',
                    templateUrl: BASE_URL + '/admin/views/books/bundle.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
            }
        })
        .state('admin.books.bundle', {
            parent: 'masterAdmin',
            url: '/book/:id/bundle',
            params : { book: null },
            views: {
                'content': {
                    controller: 'bookBundleController',
                    templateUrl: BASE_URL + '/admin/views/books/book_bundle.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
            }
        })
        .state('admin.books.package', {
            parent: 'masterAdmin',
            url: '/book/:id/package',
            params : { book: null },
            views: {
                'content': {
                    controller: 'bookPackageController',
                    templateUrl: BASE_URL + '/admin/views/books/book_package.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
            }
        })
        .state('admin.package', {
            parent: 'masterAdmin',
            url: '/package/:id',
            views: {
                'content': {
                    controller: 'packageController',
                    templateUrl: BASE_URL + '/admin/views/books/package.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
            }
        })
        .state('admin.bills', {
            parent: 'masterAdmin',
            url: '/bills',
            views: {
                'content': {
                    controller: 'billController',
                    templateUrl: BASE_URL + '/admin/views/bills/list.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
            }
        })
        .state('admin.bills.carts', {
            parent: 'masterAdmin',
            url: '/bills/{id}/carts',
            views: {
                'content': {
                    controller: 'billCartController',
                    templateUrl: BASE_URL + '/admin/views/bills/cart.html'
                },
                'sidebar' : {
                    templateUrl: BASE_URL + '/admin/views/partial/sidebar.html'
                },
                'header': {
                    controller: 'headerController',
                    templateUrl: BASE_URL + '/admin/views/partial/header.html'
                },
            }
        })
}]);
