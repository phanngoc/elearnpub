@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/checkout.css')!!}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ Asset('react/react.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/react-with-addons.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/JSXTransformer.js') }}"></script>
<script type="text/javascript" src="{{ Asset('jquery.numeric.js') }}"></script>
<script type="text/javascript" src="{{ Asset('underscore.js') }}"></script>

<div class="content-wrapper">

    <div class="inner-content-wrapper">
    	<form action="{{route('postcheckout')}}" role="form" method="POST">
    		<h3>Checkout Infomation</h3>
    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
    		<div class="form-group">
    			<label for="address_receive_good">Address receive good (if leave blank it will take your address account)</label>
    			<input type="text" class="form-control" name="address_receive_good" value="{{old('address_receive_good')}}">
    		</div>
    		<div class="form-group">
    			<label for="phone">Your phone number</label>
    			<input type="text" class="form-control" name="phone" value="{{old('phone')}}" />
    			{{ $errors->checkout->first('phone') }}
    		</div>
    		<div class="form-group">
    			<label for="coupon_code">Your coupon code</label>
    			<input type="text" class="form-control" name="coupon_code" value="{{old('coupon_code')}}" />
    		</div>
    		<button type="submit" class="btn btn-primary">Accept</button>
    	</form>
    </div>
</div>

@stop