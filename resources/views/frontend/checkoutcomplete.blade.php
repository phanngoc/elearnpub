@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/checkoutcomplete.css')!!}" rel="stylesheet" type="text/css" />

<div class="content-wrapper">

    <div class="inner-content-wrapper">
        <div class="wrap-content">
            <h3 class="message">Thank you for purchase</h3>
            <h4>You can continue buy book , return bookstore <a href="#">click here</a></h4>    
        </div>
    	
    </div>
</div>

@stop