@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/login.css')!!}" rel="stylesheet" type="text/css" />
<div class="content-wrapper">

    <!-- Main content -->
    <div class="inner-content-wrapper">
    	
    	<header>
    		<h3>Sign in</h3>	
    	</header>

 		<form role="form" method="POST" action="{{ route('login') }}">

 		 	<div class="errors">
				@if(Session::has('errors'))
					<? $errors = Session::get('errors'); ?>
					<div class="alert alert-error">
					    <button type="button" class="close" data-dismiss="alert">&times;</button>
					    <ul>
					     	    @if ($errors->has())
							        <div class="alert alert-danger">
							            @foreach ($errors->all() as $error)
							                {{ $error }}<br>        
							            @endforeach
							        </div>
						        @endif
					    </ul>
					</div>
				@endif
 			 </div>
 		  <input type="hidden" name="_token" value="{{ csrf_token() }}">

		  <div class="form-group">
		    <label for="email">Email address:</label>
		    <input type="email" class="form-control" id="email" name="email">
		  </div>

		  <div class="form-group">
		    <label for="pwd">Password:</label>
		    <input type="password" class="form-control" id="pwd" name="password">
		  </div>

		  <div class="checkbox">
		    <label><input type="checkbox" name="remember">Remember me</label>
		  </div>
		  <button type="submit" class="btn btn-primary submit">Submit</button>
		</form>

    </div>

</div>

@stop