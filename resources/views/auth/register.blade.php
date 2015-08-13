@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/signup.css')!!}" rel="stylesheet" type="text/css" />
<div class="content-wrapper">

    <!-- Main content -->
    <div class="inner-content-wrapper">
    	<header>
    		<h3>Sign Up</h3>	
    	</header>
 		<form role="form">
		  <div class="form-group">
		    <label for="email">Email address:</label>
		    <input type="email" class="form-control" id="email">
		  </div>
		  <div class="form-group">
		    <label for="pwd">Password:</label>
		    <input type="password" class="form-control" id="pwd">
		  </div>
		  <div class="checkbox">
		    <label><input type="checkbox"> Remember me</label>
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>

    </div>

</div>

@stop