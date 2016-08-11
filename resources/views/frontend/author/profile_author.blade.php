@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/profile_author.css')!!}" rel="stylesheet" type="text/css" />

<div class="content-wrapper">
    <!-- Main content -->
    <section class="large-container">
      <div class="sec-intro">
        <div class="row">
          <div class="col-md-5">
            <div class="in-wr-left">
              <div class="img-ava">
                <img src="{{ Asset('avatar/'.$author->avatar) }}"/>
              </div>
              <div class="social">
                @if (!empty($author->twitter_id))
                  <a title="{{$author->twitter_id}}" target="_blank" href="https://twitter.com/{{$author->twitter_id}}">
                    <i class="fa fa-twitter twitter-icon"></i>
                  </a>
                @endif
                @if (!empty($author->github))
                  <a title="{{$author->github}}" target="_blank" href="https://github.com/{{$author->github}}">
                    <i class="fa fa-github"></i>
                  </a>
                @endif
                @if (!empty($author->googleplus))
                  <a title="{{$author->googleplus}}" target="_blank" href="https://twitter.com/{{$author->googleplus}}">
                    <i class="fa fa-google-plus"></i>
                  </a>
                @endif
              </div> <!-- .social -->
            </div> <!-- .in-wr-left -->
          </div> <!-- .col-md-3 -->

          <div class="col-md-7">
            <div class="name-author">
              <h3>{{$author->lastname." ".$author->firstname}}</h3>
            </div>
            <div class="blurb">
              {{$author->blurb}}
            </div>
          </div> <!-- .col-md-9 -->

        </div>
      </div> <!-- .sec-intro -->

      <div class="sec-publish-book">
        <div class="in-pub">
          <header>
            <h3 class="list-title">Published Books</h3>
          </header>
          <div class="book-grid row">
            @foreach ($bookPublish as $book)
            <div class="book-list-item col-lg-2 col-md-3 col-sm-3 col-xs-12">
              <div class="in-bo-li-it">
                <div class="conver-image-book">
                  <a href="{{route('bookhome', $book->bookurl)}}">
                    <img src="{{Asset('resourcebook/'.$book->diravatar)}}">
                  </a>
                </div> <!-- .conver-image-book -->
                <div class="list-item-meta">
                    <p class="list-item-title">
                      <a href="{{ route('bookhome', $book->bookurl) }}">{{$book->title}}</a>
                    </p>
                </div> <!-- .list-item-meta -->
              </div> <!-- .in-bo-li-it -->
            </div>
            @endforeach
          </div> <!-- .book-grid -->
        </div>
      </div> <!-- .sec-publish-book -->

      <div class="sec-unpublish-book">
        <div class="in-unpub">
          <header>
            <h3 class="list-title">Published Books</h3>
          </header>
          <div class="book-grid row">
            @foreach ($bookUnpublish as $book)
              <div class="book-list-item col-lg-2 col-md-3 col-sm-3 col-xs-12">
                <div class="in-bo-li-it">
                  <div class="conver-image-book">
                    <a href="{{route('bookhome', $book->bookurl)}}">
                      <img src="{{Asset('resourcebook/'.$book->diravatar)}}">
                    </a>
                  </div> <!-- .conver-image-book -->
                  <div class="list-item-meta">
                      <p class="list-item-title">
                        <a href="{{ route('bookhome', $book->bookurl) }}">{{$book->title}}</a>
                      </p>
                  </div>
               </div> <!-- .in-bo-li-it -->
              </div> <!-- .book-list-item -->
            @endforeach
          </div> <!-- .book-grid -->
        </div> <!-- .in-unpub -->
      </div> <!-- .sec-unpublish-book -->

    </section>
</div>

<script type="text/javascript">
  $(document).ready(function(){

  });
</script>

@stop
