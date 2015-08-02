<section class="header">
	<div class="inner row">
		<div class="col-md-5">
			<ul class="navigation">
				<li><a href="#">Bookstore</a></li>
				<li><a href="#">Authors</a></li>
			</ul>
		</div>
		<div class="col-md-2">
			<div class="inner-image-home">
				<a href="{{URL::to('/')}}"><img src="{{ Asset('images/leanpub-logo-centred-black-footer.png') }}" /></a>
			</div>
		</div>
		<div class="col-md-5">
			<div class="navigation-tools">
				 <div class="dropdown" id="main-menu">
				    <button class="btn-account">Account
				    	<span class="caret"></span>
				    </button>
				    <div class="area-dropdown">
				    	<ul class="list-item-menu">
					      <li><a href="#">HTML</a></li>
					      <li><a href="#">CSS</a></li>
					      <li><a href="#">JavaScript</a></li>
					    </ul>
				    </div>
				 </div>

				  <div class="shopping-cart-button">
					<a href="/shopping_cart" title="Shopping Cart">
						<div id="shopping-cart">
						<i class="fa fa-shopping-cart"></i>
						<span id="cart-total">0</span>
						</div>
					</a>
				  </div>

				  <div class="search-bar">
					<div class="search-and-submit">
						<form action="/book_search" method="get">
							<input name="search" placeholder="Search" type="search" />
							<button class="search-submit" type="submit">
							  <div class="search-icon"></div>
							</button>
						</form>
					</div>
				  </div>
			</div>
		</div>
	</div>

</section>
<script type="text/javascript">
	$(document).ready(function(){
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