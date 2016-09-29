<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Admin manage user</title>
    <!-- Angular -->
    <script src="{{ Asset('bower_resources/angular/angular.min.js') }}" type="text/javascript"></script>
    <!-- Jquery -->
    <script src="{{ Asset('bower_resources/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{ Asset('bower_resources/bootstrap/dist/js/bootstrap.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ Asset('bower_resources/bootstrap/dist/css/bootstrap.css') }}" media="screen" title="no title">
    <link rel="stylesheet" href="{{ Asset('bower_resources/bootstrap/dist/css/bootstrap-theme.css') }}" media="screen" title="no title">
    <!-- Angular ui router -->
    <script src="{{ Asset('bower_resources/angular-ui-router/release/angular-ui-router.js') }}" type="text/javascript"></script>
    <!-- Angular animate -->
    <script src="{{ Asset('bower_resources/angular-animate/angular-animate.js') }}" type="text/javascript"></script>
    <!-- Angular angular-aria -->
    <script src="{{ Asset('bower_resources/angular-aria/angular-aria.js') }}" type="text/javascript"></script>
    <!-- Angular material -->
    <script src="{{ Asset('bower_resources/angular-material/angular-material.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ Asset('bower_resources/angular-material/angular-material.css') }}" media="screen" title="no title">
    <!-- Angular bootstrap -->
    <script src="{{ Asset('bower_resources/angular-bootstrap/ui-bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ Asset('bower_resources/angular-bootstrap/ui-bootstrap-tpls.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ Asset('bower_resources/angular-bootstrap/ui-bootstrap-csp.css') }}" media="screen" title="no title">
    <!-- Font awesome -->
    <link rel="stylesheet" href="{{ Asset('bower_resources/components-font-awesome/css/font-awesome.css') }}" media="screen" title="no title">
    <!-- Material+Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Angular ui notification -->
    <link rel="stylesheet" href="{{ Asset('bower_resources/angular-ui-notification/dist/angular-ui-notification.min.css') }}" />
    <script src="{{ Asset('bower_resources/angular-ui-notification/dist/angular-ui-notification.min.js') }}"></script>
    <!-- Angular ng progress -->
    <script src="{{ Asset('bower_resources/ngprogress/build/ngprogress.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ Asset('bower_resources/ngprogress/ngProgress.css') }}">
    <!-- Ng-message -->
    <script src="{{ Asset('bower_resources/angular-messages/angular-messages.js') }}"></script>
    <!-- Underscore -->
    <script src="{{ Asset('bower_resources/underscore/underscore.js') }}"></script>

    <script type="text/javascript">
        var TOKEN = '{{ csrf_token() }}';
    </script>

    <script type="text/javascript" src="{{ Asset('admin/app.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('admin/main.js') }}"></script>

    <!-- Filter -->
    <script type="text/javascript" src="{{ Asset('admin/filters/generalFilter.js') }}"></script>
    <!-- Services -->
    <script type="text/javascript" src="{{ Asset('admin/services/generalService.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('admin/services/userService.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('admin/services/bookService.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('admin/services/bundleService.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('admin/services/packageService.js') }}"></script>

    <!-- Controller -->
    <script src="{{Asset('admin/controllers/loginController.js')}}" type="text/javascript"></script>
    <script src="{{Asset('admin/controllers/headerController.js')}}" type="text/javascript"></script>

    <script src="{{Asset('admin/controllers/listUserController.js')}}" type="text/javascript"></script>
    <script src="{{Asset('admin/controllers/updateUserController.js')}}" type="text/javascript"></script>
    <script src="{{Asset('admin/controllers/homeController.js')}}" type="text/javascript"></script>
    <script src="{{Asset('admin/controllers/listBookController.js')}}" type="text/javascript"></script>

    <script src="{{Asset('admin/controllers/bundleController.js')}}" type="text/javascript"></script>
    <script src="{{Asset('admin/controllers/bookBundleController.js')}}" type="text/javascript"></script>

    <script src="{{Asset('admin/controllers/packageController.js')}}" type="text/javascript"></script>
    <script src="{{Asset('admin/controllers/bookPackageController.js')}}" type="text/javascript"></script>

    <!-- My code -->
    <!-- <link rel="stylesheet" href="{{Asset('admin/styles/css/simple-sidebar.css')}}" media="screen" title="no title"> -->
    <link rel="stylesheet" href="{{Asset('admin/styles/css/common.css')}}" media="screen" title="no title">
    <link rel="stylesheet" href="{{Asset('admin/styles/css/home.css')}}" media="screen" title="no title">
    <link rel="stylesheet" href="{{Asset('admin/styles/css/listuser.css')}}" media="screen" title="no title">
    <link rel="stylesheet" href="{{Asset('admin/styles/css/edituser.css')}}" media="screen" title="no title">
    <!-- End my code -->

  </head>

  <body ng-app="learnPubApp">
      <div ui-view="main"></div>
  </body>

</html>
