@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/home.css')!!}" rel="stylesheet" type="text/css" />
<div class="content-wrapper">

    <!-- Main content -->
    <section class="large-container">
        <div class="row">
        	<div class="book-list-wrapper">

                <div class="list-header">
                    <header class="list-title">
                      <h3><a href="#">Best Seller</a></h3>    
                    </header>   
                    <div class="list-controls">
                        <a href="#">View All</a>
                        <div class="icon-control">
                            <div class="icon-button">
                                <div class="icon-prev"></div>
                                <div class="icon-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
        		
        		<div class="list-content">
        			<div class="list-content-wrapper">
        				<ul class="list-detail">
        				  	@foreach ($books as $book)
							    <li class="item-book">
							    	<div class="avatar-wrapper">
							    		<a href="#"><img src="{{ Asset('resourcebook/'.$book['avatar']) }}"/></a>
							    	</div>
                                    <div class="info-name">
                                        <span>{{ $book['title'] }}</span>
                                    </div>
                                    <div class="info-author">
                                        <span>
                                            <?php 
                                               echo $book['meta']->lastname." ".$book['meta']->firstname;  
                                            ?>
                                        </span>
                                    </div>
							    </li>
							@endforeach

        				</ul>
        			</div>
        		</div>
        	</div>
        </div>
    </section>

</div>
@stop