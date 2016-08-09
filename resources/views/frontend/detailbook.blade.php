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

<script type="text/javascript" src="{{ Asset('jquery.numeric.js') }}"></script>

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
                            @if ($book->is_publish_sample)
                              <div class="downloadsample"><a href="{{ route('downloadSample',$book->id) }}">Download Sample</a></div>
                            @endif
                            <div class="wishlist"><a href="{{ route('addwishlist',$book->id) }}">Add to Wish List</a></div>
                        </div>

                     </div>
                     <div class="group-price">
                         <div class="inner-group-price">
                             <header class="row">
                                 <div class="minimum"><p class="number">${{ $book->price->minimumprice }}</p><span class="suffix">MINIMUM</span></div>
                                 <div class="maximum"><p class="number">${{ $book->price->suggestedprice }}</p><span class="suffix">SUGGESTED</span></div>
                             </header>
                             <form action="{{ route('addItemToCart')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="bookid" value="{{ $book->id }}">
                                 <div class="content-slider-price">
                                     <p class="label-message">You pay</p>
                                     <div class="row">
                                         <div class="col-md-2 col-sm-2 rmpadding">
                                             <div class="input-group">
                                                  <span class="input-group-addon" id="basic-addon1">$</span>
                                                  <input type="text" class="form-control" placeholder="00" value="{{ $book->price->minimumprice }}" id="amount-you-pay" name="amountYouPay"/>
                                             </div>
                                         </div>
                                         <div class="col-md-10 col-sm-10">
                                             <div class="slider-range-you-pay"></div>
                                         </div>
                                     </div>

                                     <p class="label-message">Author earns</p>
                                     <div class="row">
                                         <div class="col-md-2 col-sm-2 rmpadding">
                                             <div class="input-group">
                                                  <span class="input-group-addon" id="basic-addon1">$</span>
                                                  <input type="text" class="form-control" placeholder="00" value="{{ $book->price->minimumprice * 90/100 }}" id="amount-author-earn" name="amountAuthorEarn"/>
                                             </div>
                                         </div>
                                         <div class="col-md-10 col-sm-10">
                                             <div class="slider-range-author-earn"></div>
                                         </div>
                                     </div>
                                 </div>

                                 <div class="add-ebook-to-cart">
                                     <button href="#" class="inner-add-ebook-to-card">Add Ebook to Cart</button>
                                 </div>
                             </form>
                         </div>
                     </div>
               </div>
           </div>
       </div>

    </div>
</section>

<section class="aboutbook row">
    <div class="inner-about-book">
        <header><h3>About the book</h3></header>
        <div class="content">
            <div class="wrap-content row">
              <div class="col-md-8">
                  <div class="text-content">
                      {{ $book->description }}
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="content-control">
                      <div class="feedback">
                        <h4>FEEDBACK<i class="fa fa-comments"></i></h4>
                        <ul>
                            <li><a href="#">Discuss this book</a></li>
                            <li><a href="#">Email the Author</a></li>
                        </ul>
                      </div>
                      <div class="share">
                          <h4>SHARE THIS BOOK<i class="fa fa-share-alt"></i></h4>
                          <ul>
                                <li class="facebook">
                                    <i class="fa fa-facebook"></i>
                                </li>
                                <li class="twitter">
                                    <i class="fa fa-twitter"></i>
                                </li>
                                <li class="google">
                                    <i class="fa fa-google"></i>
                                </li>
                          </ul>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>
<section class="row about-author">
    <div class="inner-about-author">
        <header><h3>About the author</h3></header>
        <div class="content row">
            <div class="col-md-5">
                <div class="inner-left">
                    <div class="wrapper-avatar">
                        <img src="{{ Asset('avatar/'.$book->meta->avatar) }}" alt="avatar">
                    </div>
                    <div class="wrapper-social">
                        <ul class="list-social">
                            <li class="facebook">
                                <i class="fa fa-facebook"></i>
                            </li>
                            <li class="twitter">
                                <i class="fa fa-twitter"></i>
                            </li>
                            <li class="google">
                                <i class="fa fa-google"></i>
                            </li>
                            <li class="github">
                                <i class="fa fa-github-alt"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="inner-right">
                    <h3>{{ $book->meta->lastname." ".$book->meta->firstname }}</h3>
                    <div class="description">
                       {{ $book->meta->blurb }}
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

        $("#amount-you-pay").numeric({negative : false,decimalPlaces : 2});
        $("#amount-author-earn").numeric({negative : false,decimalPlaces : 2})

        $("#amount-you-pay").keyup(function(event){
            if(event.keyCode == 13){
               var val = $(this).val();
               var valmax = $( ".slider-range-you-pay" ).slider('option','max');
               if(val < valmax)
               {
                $( ".slider-range-you-pay" ).slider('option','value',val);
               }
               else
               {
                $( ".slider-range-you-pay" ).slider('option','value',valmax);
               }
            }
        });

        $("#amount-author-earn").keyup(function(event){
            if(event.keyCode == 13){
               var val = $(this).val();
               var valmax = $( ".slider-range-author-earn" ).slider('option','max');
               if(val < valmax)
               {
                $( ".slider-range-author-earn" ).slider('option','value',val);
               }
               else
               {
                $( ".slider-range-author-earn" ).slider('option','value',valmax);
               }
            }
        });

        $( ".slider-range-you-pay" ).slider({
              orientation: "horizontal",
              range: "min",
              min: 0,
              step : 0.5,
              max: {{ ($book->price->suggestedprice * 2 == 0) ? 50 : $book->price->suggestedprice }},
              value: {{ $book->price->minimumprice * 1.2 }},
              change: function( event, ui ) {
                $('#amount-you-pay').val(ui.value);
              },
              slide: function( event, ui ) {
                 if( ui.value < {{ $book->price->minimumprice}} ){
                       return false;
                 }
                 $('#amount-you-pay').val(ui.value);
                 var value = ui.value * 90/100 ;
                 $( ".slider-range-author-earn" ).slider('option','value',value);
              }
        });

        $( ".slider-range-author-earn" ).slider({
              orientation: "horizontal",
              range: "min",
              min : 0,
              step : 0.5,
              max: {{ ($book->price->suggestedprice * 2 * 90/100 == 0) ? 45 : $book->price->suggestedprice }},
              value: {{ $book->price->minimumprice * 1.2 * 90/100 }},
              change: function( event, ui ) {
                $('#amount-author-earn').val(ui.value);
              },
              slide: function( event, ui ) {
                 if( ui.value < {{ $book->price->minimumprice * 90 / 100 }} ){

                       return false;
                 }
                 $('#amount-author-earn').val(ui.value);
                 var value = ui.value * 100/90 ;
                 $( ".slider-range-you-pay" ).slider('option','value',value);
              }
        });
    });
</script>
@stop
