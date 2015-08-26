@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/home.css')!!}" rel="stylesheet" type="text/css" />
<div class="content-wrapper">

    <!-- Main content -->
    <section class="large-container">
        <!-- Best seller -->
        <div class="row">
        	<div class="book-list-wrapper">
                <div class="list-header">
                    <header class="list-title">
                      <h3><a href="#">Best Seller</a></h3>    
                    </header>   
                    <div class="list-controls">
                        <a href="#" class="view_all">View All</a>
                    </div>
                </div>
        		
        		<div class="list-content">
                    <div class="list-content-wrapper">
                        <div class="owl-carousel">
        				  	@foreach ($books as $book)
							    <div class="item-book">
							    	<div class="avatar-wrapper">
							    		<a href="{{ route('bookhome',$book['bookurl']) }}"><img src="{{ Asset('resourcebook/'.$book['diravatar']) }}"/></a>
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
							    </div>
							@endforeach
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <!-- End Best seller -->

        <!-- Feature book -->
        <div class="row">
            <div class="book-list-wrapper">

                <div class="list-header">
                    <header class="list-title">
                      <h3><a href="#">Feature book</a></h3>    
                    </header>   
                    <div class="list-controls">
                        <a href="#" class="view-all">View All</a>
                    </div>
                </div>
                
                <div class="list-content">
                    <div class="list-content-wrapper">
                        <div class="owl-carousel">
                            @foreach ($bookfeature as $bofea)
                                <div class="item-book">
                                    <div class="avatar-wrapper">
                                        <a href="{{ route('bookhome',$bofea['bookurl']) }}"><img src="{{ Asset('resourcebook/'.$bofea['diravatar']) }}"/></a>
                                    </div>
                                    <div class="info-name">
                                        <span>{{ $bofea['title'] }}</span>
                                    </div>
                                    <div class="info-author">
                                        <span>
                                            <?php 
                                               echo $bofea['meta']->lastname." ".$bofea['meta']->firstname;  
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End feature book -->

    </section>

</div>

<link href="http://cdn.jsdelivr.net/jquery.owlcarousel/1.31/owl.carousel.css" rel="stylesheet" />
<link href="http://cdn.jsdelivr.net/jquery.owlcarousel/1.31/owl.theme.css" rel="stylesheet" />
<script src="http://cdn.jsdelivr.net/jquery.owlcarousel/1.31/owl.carousel.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        // $('.list-content-wrapper').css({'overflow':'hidden','position':'relative'});
        var owl = $('.owl-carousel').owlCarousel({
            items : 5,
            afterMove: function (elem) {
              var current = this.currentItem;
              var src = elem.find(".owl-item").eq(current).find("img").attr('src');
              console.log('Image current is ' + src);
            }
        });
       $('.icon-prev').click(function(){
            // var nextItem = owl.currentItem + 1
            // owl.trigger('owl.goTo', nextItem);
             console.log('da prev');
             owl.trigger('prev.owl.carousel');
       });
       $('.icon-next').click(function(){
            // var nextItem = owl.currentItem + 1
            // owl.trigger('owl.goTo', nextItem);
             console.log('da next');
             owl.trigger('next.owl.carousel');
       });
        

        
    });

</script>
@stop