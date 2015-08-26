<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>@yield('head.title')</title>
    <link rel="shortcut icon" href="http://asiantech.vn/favicon.ico" type="">
    <link rel="stylesheet" href="{{Asset('lesscss/css/general.css')}}" media="screen" title="no title" charset="utf-8" />

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <script type="text/javascript" src="{{ Asset('jquery/jquery-1.11.3.js') }}"></script>
    <!-- Bootstrap 3.3.4 -->
    <script type="text/javascript" src="{{ Asset('bootstrap/js/bootstrap.min.js') }}"></script>
	  <link rel="stylesheet" type="text/css" href="{{ Asset('bootstrap/css/bootstrap.min.css') }}"/>
    <!-- FontAwesome 4.3.0 -->
    <link href="{!!Asset('Font-Awesome-master/css/font-awesome.min.css')!!}" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="{!!Asset('font-awesome/ionicons.min.css')!!}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{!!Asset('normalize.css')!!}" rel="stylesheet" type="text/css" />
    @yield('head.css')

  </head>

  <body class="skin-blue sidebar-mini">
	    <div class="wrapper">

	      @include ('frontend.header')

	        <section class="view">
	            <div class="inner-view">
	                @yield('body.content')
	            </div>
	        </section>
          @include ('frontend.footer')
	    </div>
    <!-- End Wrapper -->
  </body>
</html>
