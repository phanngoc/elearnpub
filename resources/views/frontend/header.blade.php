<section class="header">
	<div class="inner-header">

	    <div class="logo">
			<div class="inner-image-home">
				<a href="{{URL::to('/')}}"><img src="{{ Asset('images/leanpub-logo-centred-black-footer.png') }}" /></a>
			</div>
	    </div>

	    <div class="list-menu">
	    	<div class="open-menu" style="display:none">
	    		<i class="fa fa-bars"></i>
	    	</div>
	    	<ul class="navigation">
				<li><a href="#">Home</a></li>
				<li><a href="{{ route('library') }}">Read</a></li>
				<li><a href="{{ route('new_book') }}">Write</a></li>
			</ul>
	    </div>

<script type="text/javascript">

	$(document).ready(function(){
		responsive();
	});
	$( window ).resize(function() {
		responsive();
	});

	function responsive()
	{
	  var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
	  console.log(width);
	  if(width < 1000)
	  {
	  	$('.list-menu').css({'position':'relative'});
	  	$('.open-menu').css({'display':'block'});
	  	$('ul.navigation').css({'display':'none','position':'absolute'});
	  	$('.open-menu').unbind( "click" );
	  	$('.open-menu').click(function(){
	  		if($('ul.navigation').css('display') == 'none')
	  		{
	  			$('ul.navigation').css({'display':'block'});
	  			console.log('ul.navigation open');
	  		}
	  		else
	  		{
	  			console.log('ul.navigation close');
	  			$('ul.navigation').css({'display':'none'});
	  		}
	  	});
	  }
	  else
	  {
	  	$('.open-menu').css({'display':'none'});
	  	$('ul.navigation').css({'display':'block','position':'static'});
	  }

	  if(width < 605)
	  {
	  	$('.logo').hide();
	  }
	  else
	  {
	  	$('.logo').show();
	  }
	}

</script>
		<!-- <div class="col-md-1"></div> -->

		<div class="area-right">
				<div class="search-bar">
					<div class="search-and-submit">
						<form action="{{route('search')}}" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input name="search" placeholder="Search" type="search" />
							<button class="search-submit" type="submit">
							  	<div class="search-icon"></div>
							</button>
						</form>
					</div>
				</div>

				<div class="shopping-cart-button">
						<a href="{{route('getCart')}}" title="Shopping Cart">
							<div id="shopping-cart">
								<i class="fa fa-shopping-cart"></i>
								<span id="cart-total">{{count(Session::get('carts',array()))}}</span>
							</div>
						</a>
				</div> <!-- .shopping-cart-button -->

				<?php if(null !==Auth::user()) { ?>
					<div class="profile">
						<div class="wrapper-profile">
							<div class="img-avatar"><img src="<?php echo showImage(Auth::user()->avatar); ?>"/> </div>
							<div class="dropdown">
								<div class="inner-dropdown">
										<div class="column">
											<h4>Account</h4>
											<ul>
												<li><a href="{{ route('library') }}">Read</a></li>
												<li><a href="{{ route('wishlist') }}">Wishlist</a></li>
												<li><a href="#">Purchase</a></li>
												<li><a href="{{ route('invitation') }}">Invitations</a></li>
												<li><a href="#">Setting</a></li>
											</ul>
										</div>
										<div class="column">
											<h4>Author</h4>
											<ul>
												<li><a href="{{route('book')}}">Books</a></li>
												<li><a href="{{ route('bundles') }}">Bundle</a></li>
												<li><a href="{{ route('profile') }}">Profile</a></li>
											</ul>
										</div>
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="area-login">
						<div class="inner-area-login">
							<a href="auth/login" class="btn btn-primary">Sign in</a>
						</div>
					</div>
				<?php } ?>
		</div>
	</div> <!-- .inner-header -->
</section>

<script type="text/javascript">
	$(document).ready(function(){
		$('.profile .dropdown').hide();
		$('.profile .img-avatar').click(function(){
			console.log('co vao');
			$(this).parent().find('.dropdown').toggle();
		});

		$('.area-dropdown').css({'display':'none'});
		$('.btn-account').click(function(){
			if($('.area-dropdown').css('display')=='none')
			{
				$('.area-dropdown').css({'display' : 'block'});
			}
			else
			{
				$('.area-dropdown').css({'display' : 'none'});
			}
		});
		// $('input[name="search"],.search-and-submit').focus(function(){
		// 	$(this).animate({
		// 	    width: "178px",

		// 	  }, 500, function() {
		// 	    // Animation complete.
		// 	  });
		// });
		// $("input[name='search'],.search-and-submit").focusout(function(){
		//     $(this).animate({
		// 	    width: "100px",

		// 	  }, 500, function() {
		// 	    // Animation complete.
		// 	  });
		// });
	});
</script>
<link rel="stylesheet" href="{{ Asset('lesscss/css/header.css') }}">
