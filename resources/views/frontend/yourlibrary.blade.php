@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/yourlibrary.css')!!}" rel="stylesheet" type="text/css" />

<div class="content-wrapper">

    <!-- Main content -->
    <section class="large-container">
        <div id="inner-wrapper-library">
            <header>
              <h3>Your library</h3>    
            </header>
            <div class="content">
              <div class="inner-content">
               <?php
                foreach ($bookLibrarys as $key => $value) {
                  ?>
                    <div class="item-library">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="wrap-avatar">
                              <img src="{{ Asset('resourcebook/'.$value->diravatar) }}">
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="wrap-content">
                              <h4>{{ $value->title }}</h4>
                              <p>{{ $value->teaser }}</p>
                              <div class="author">
                                <?php $authors = $value->author()->get();?>
                                @foreach($authors as $author)
                                    <span><a href="">{{ $author->lastname.' '.$author->firstname }}</a></span>
                                @endforeach
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