@extends ('frontend.master')

@section ('head.title')
    {{ $bundle->title }}
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/bundle_detail.css')!!}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{!!Asset('jquery-ui/jquery-ui.css')!!}">
<link rel="stylesheet" href="{!!Asset('jquery-ui/jquery-ui.theme.css')!!}">
<link rel="stylesheet" href="{!!Asset('jquery-ui/jquery-ui.structure.css')!!}">
<script type="text/javascript" src="{{ Asset('jquery-ui/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ Asset('jquery.numeric.js') }}"></script>

<section class="content-wrapper">
    <!-- Main content -->
    <div class="large-container">

      <div class="header">
         <h4>{{ $bundle->title }}</h4>
      </div> <!-- .group-header -->

       <div class="row">
           <div class="col-md-6">
               <div class="inner-col-left">
                 <?php
                  $books = $bundle->books;
                 ?>
                 <div class="wrap-avatar count-{{ count($books) }}">

                     @foreach($books as $book)
                       <div class="cover-image">
                         <a href="#" title="{{ $book->title }}">
                             <img src="{{ Asset('resourcebook/' . $book->diravatar) }}" alt="">
                         </a>
                       </div>

                     @endforeach
                 </div> <!-- .cover-avatar -->
               </div> <!-- .inner-col-left -->
           </div> <!-- .col-md-6-->

           <div class="col-md-6">
               <div class="inner-col-right">
                     <div class="group-price">
                         <div class="inner-group-price">
                             <header class="row">
                                 <div class="minimum"><p class="number">${{ $bundle->price->minimumprice }}</p><span class="suffix">MINIMUM</span></div>
                                 <div class="maximum"><p class="number">${{ $bundle->price->suggestedprice }}</p><span class="suffix">SUGGESTED</span></div>
                             </header>
                             <form action="{{ route('addItemToCart')}}" method="POST">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="item_id" value="{{ $bundle->id }}">
                                 <input type="hidden" name="type" value="2">
                                 <div class="content-slider-price">
                                     <p class="label-message">You pay</p>
                                     <div class="row">
                                         <div class="col-md-2 col-sm-2 rmpadding">
                                             <div class="input-group">
                                                  <span class="input-group-addon" id="basic-addon1">$</span>
                                                  <input type="text" class="form-control" placeholder="00" value="{{ $bundle->price->minimumprice }}" id="amount-you-pay" name="amountYouPay"/>
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
                                                  <input type="text" class="form-control" placeholder="00" value="{{ $bundle->price->minimumprice * 90/100 }}" id="amount-author-earn" name="amountAuthorEarn"/>
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
                         </div> <!-- .inner-group-price -->
                     </div> <!-- .group-price -->
               </div> <!-- .inner-col-right -->
           </div> <!-- .col-md-6 -->
       </div>

    </div>
</section>

<section class="about-bundle row">
    <div class="inner-about-bundle">
        <header><h3>About the bundle</h3></header>
        <div class="content">
            <div class="wrap-content row">
              <div class="col-md-8">
                  <div class="text-content">
                      {{ $bundle->description }}
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



<section class="row about-books">
    <div class="inner-about-books">
        <header><h3>About the Books</h3></header>

        <div class="wrap-list-book container">
          <?php
            $books = $bundle->books;
          ?>
          @foreach($books as $book)
            <div class="item-book row">
                <div class="col-md-2">
                    <div class="wrapper-avatar">
                        <img src="{{ imageBook($book->diravatar) }}" alt="avatar" />
                    </div> <!-- .wrapper-avatar -->
                </div>
                <div class="col-md-10">
                    <div class="bundle-book">
                        <div class="book-title">
                            <h3>{{ $book->title }}</h3>
                        </div> <!-- .book-title -->

                        <div class="avatar-and-name">
                            <a href="{{ route('userprofile', $book->main_author->first()->id) }}">
                                <img src="{{ imageUser($book->main_author->first()->avatar) }}" alt="" />
                                {{ $book->main_author->first()->lastname." ".$book->main_author->first()->firstname }}
                            </a>
                        </div>

                        <div class="wrap-des">
                          <div class="description">
                             {{ $book->description }}
                          </div>
                        </div>

                        <p class="show-more">
                          <span class="readmore">Read more</span>
                          <span class="readless" style="display:none">Read less</span>
                        </p>
                    </div>
                </div>
            </div>
          @endforeach
        </div> <!-- .wrap-list-book -->
    </div> <!-- .inner-about-books -->
</section>

<script type="text/javascript">
  var SUGGESTED_PRICE = {{$bundle->price->suggestedprice}};
  var MINIMUM_PRICE = {{$bundle->price->minimumprice}};
</script>

<script type="text/javascript" src="{{ Asset('js/bundle_detail.js') }}"></script>
@stop
