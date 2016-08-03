@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/dashboardbook.css')!!}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ Asset('react/react.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/react-with-addons.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/JSXTransformer.js') }}"></script>
<script type="text/javascript" src="{{ Asset('jquery.numeric.js') }}"></script>
<script type="text/javascript" src="{{ Asset('underscore.js') }}"></script>

<div class="content-wrapper">
    <section class="large-container">
        <div id="inner-wrapper-listbook" class="row">
        
          @include('frontend.author_dashboard')

          <div class="col-md-9">
            <div class="inner-content">
              <section class="info-top">
                <h3>New Book</h3>
                <div class="inner-form">
                  <form action="{{ route('post_new_book') }}" role="form" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                      <label for="title">Book Title</label>
                      <input type="text" class="form-control haft-width" name="title"/>
                      {{ $errors->newbook->first('title') }}
                    </div>
                    <div class="form-group">
                      <label for="title">Book Url</label>
                      <div class="input-group">
                           <span class="input-group-addon">#</span>
                           <input type="text" class="form-control haft-width" name="bookurl"/>
                      </div>
                      {{ $errors->newbook->first('bookurl') }}
                    </div>
                    <button class="btn btn-primary">Create Book</button>
                  </form>
                </div>
              </section>
            </div>
          </div> 
        </div>
    </section>
</div>

@stop