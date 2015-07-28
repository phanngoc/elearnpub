<section class="header">
	<div class="inner row">
		<div class="col-md-3">
			<ul class="navigation">
				<li>Bookstore</li>
				<li>Authors</li>
			</ul>
		</div>
		<div class="col-md-6">
			<div class="inner">
				<a href="{{URL::to('/')}}"><img src="{{ Asset('images/leanpub-logo-centred-black-footer.png') }}" /></a>
			</div>
		</div>
		<div class="col-md-3">
			<div class="navigation-tools">
				 <div class="dropdown" id="main-menu">
				    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
				    	<span class="caret"></span>
				    </button>
				    <ul class="dropdown-menu">
				      <li><a href="#">HTML</a></li>
				      <li><a href="#">CSS</a></li>
				      <li><a href="#">JavaScript</a></li>
				    </ul>
				  </div>
			</div>
			<div class="shopping-cart">
				<a href="#">
					<div class="search-and-submit">
						<form action="/book_search" method="get">
							<input name="search" placeholder="Search" type="search">
							<button class="search-submit" type="submit">
							  <div class="search-icon"></div>
							</button>
						</form>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>