@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/signup.css')!!}" rel="stylesheet" type="text/css" />
<div class="content-wrapper">

    <!-- Main content -->
    <section class="large-container">
 		<div class="inner-content">
 			<form role="form" class="row" method="POST" action="{{ route('register') }}">
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
 			  <div class="row">
 			  	 <div class="col-md-6">
	 			  	<div class="inner-left">
	 			  	    <div class="row">
	 			  	    	<div class="form-group col-md-6">
			 					<label for="firstname">First name</label>
			 					<input type="text" class="form-control" id="firstname" name="firstname">
			 				</div>
			 				<div class="form-group col-md-6">
			 					<label for="lastname">Last name</label>
			 					<input type="text" class="form-control" id="lastname" name="lastname">
			 				</div>
	 			  	    </div>
	 			  	 	
		 				<div class="form-group">
		 					<label for="email">Email</label>
		 					<input type="text" class="form-control" id="email" name="email">
		 				</div>

		 				<div class="form-group">
		 					<label for="password">Password</label>
		 					<input type="text" class="form-control" id="password" name="password">
		 				</div>

		 				<div class="form-group">
		 					<label for="email">Password Confirm</label>
		 					<input type="text" class="form-control" id="password_confirmation" name="password_confirmation">
		 				</div>
 			  	    </div><!-- .inner-left -->
 			  	 </div> <!-- .col-md-6 -->
 			  	 <div class="col-md-6"> 
 			  	 	<div class="inner-right">
 			  	 	    <div id="captcha">
 			  	 	    	{!! Recaptcha::render() !!}
 			  	 	    </div>
 			  	 	    <button class="btn btn-primary btn-lg submit">Submit</button>
 			  	 	</div> <!-- .inner-right -->
 			  	 </div>
 			  </div>
 				
 			</form>
 		</div>
    </section>

</div>

@stop