@extends ('frontend.master')

@section ('head.title')
    {{ $book->title }}
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/book.css')!!}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{!!Asset('jquery-ui/jquery-ui.css')!!}">
<link rel="stylesheet" href="{!!Asset('jquery-ui/jquery-ui.theme.css')!!}">
<link rel="stylesheet" href="{!!Asset('jquery-ui/jquery-ui.structure.css')!!}">
<script type="text/javascript" src="{{ Asset('jquery-ui/jquery-ui.js') }}"></script>

<section class="content-wrapper">
    <!-- Main content -->
    <div class="large-container">
        <!-- Best seller -->
       <div class="row">
           <div class="col-md-5">
               <div class="inner-col-left">
                 <div class="wrap-avatar">
                     <img src="{{ Asset('resourcebook/'.$book->avatar) }}" alt="">
                 </div>  
               </div>
           </div>
           <div class="col-md-7">
               <div class="inner-col-right">
                     <div class="group-header">
                        <h4>{{ $book->title }}</h4>
                        <p class="subtitle">{{ $book->subtitle }}</p>
                        <div class="line-author">
                            <div class="avatar">
                                <img src="{{ Asset('avatar/'.$book->meta->avatar) }}" alt=""> 
                            </div>
                            <div class="author">
                                <p>{{ $book->meta->lastname.' '.$book->meta->firstname }}</p>
                            </div>
                        </div>

                        <div class="blurb">
                          <p>{{ $book->teaser }}</p>
                        </div>

                        <div class="group-sample">
                            <p>Free sample</p>
                            <div class="downloadsample"><a href="#">Download Sample</a></div>
                            <div class="wishlist"><a href="#">Add to Wish List</a></div>
                        </div>
                        
                     </div>
                     <div class="group-price">
                         <div class="inner-group-price">
                             <header class="row">
                                 <div class="minimum"><p class="number">${{ $book->price->minimumprice }}</p><span class="suffix">MINIMUM</span></div>
                                 <div class="maximum"><p class="number">${{ $book->price->suggestedprice }}</p><span class="suffix">SUGGESTED</span></div>
                             </header>

                             <div class="content-slider-price">
                                 <p class="label-message">You pay</p>
                                 <div class="slider-range-you-pay"></div>
                                 <p class="label-message">Author earns</p>
                                 <div class="slider-range-author-earn"></div>
                             </div>

                             <div class="add-ebook-to-cart">
                                 <a href="#">Add Ebook to Cart</a>
                             </div>

                         </div>
                     </div>
               </div>
           </div>
       </div>

    </div>
</section>

<!-- <link href="http://cdn.jsdelivr.net/jquery.owlcarousel/1.31/owl.carousel.css" rel="stylesheet" />
<link href="http://cdn.jsdelivr.net/jquery.owlcarousel/1.31/owl.theme.css" rel="stylesheet" />
<script src="http://cdn.jsdelivr.net/jquery.owlcarousel/1.31/owl.carousel.min.js"></script> -->

<script type="text/javascript">
    $(document).ready(function(){
        $( ".slider-range-you-pay" ).slider({
              orientation: "horizontal",
              range: "min",
              max: 255,
              value: 127,
        });
        $( ".slider-range-author-earn" ).slider();
    });
</script>
@stop