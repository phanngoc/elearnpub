@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/wishlist.css')!!}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ Asset('react/react.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/react-with-addons.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/JSXTransformer.js') }}"></script>
<script type="text/javascript" src="{{ Asset('jquery.numeric.js') }}"></script>
<script type="text/javascript" src="{{ Asset('underscore.js') }}"></script>

<div class="content-wrapper">

    <!-- Main content -->
    <section class="large-container">
        <div id="inner-wrapper-wishlist">
            <header>
               <h3>Wish List for {{ Auth::user()->lastname." ".Auth::user()->firstname }}</h3>
               <p>To share this page with your friends and family all you need to do is send them this link: https://leanpub.com/u/phann123/wishlist. If you would like to change your username, you can do so on your account settings page.
If someone buys you a book from your wish list, we will send you an email at lequidon.1993@gmail.com. Your email will not be shared with the person buying the book.</p>
            </header>
            <div class="content">
              <div class="inner-content">
               <?php
                foreach ($wishlist as $key => $value) {
                  ?>
                    <div class="item-wish">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="wrap-avatar">
                              <img src="{{ Asset('uploads/'.$value->avatar) }}">
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="wrap-content">
                              <h4>{{ $value->title }}</h4>
                              <p>{{ $value->teaser }}</p>
                              <div class="action">
                                <a class="remove btn btn-danger" href="{{ route('deletewishlist',$value->book_id) }}">Remove</a>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  <?php
                }
               ?>
               </div>
            </div>
        </div>
    </section>
</div>

@stop
