@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/dashboardbook.css')!!}" rel="stylesheet" type="text/css" />

<div class="content-wrapper">
    <section class="large-container">
        <div id="inner-wrapper-listbook" class="row">

          @include('frontend.author_dashboard')
    
          <div class="col-md-9">
            <div class="inner-content">
              <section class="info-top">
                <h3>Author Profile</h3>
              </section>

              <section class="area-form">
                <form action="{{ route('postprofile') }}" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                 <h4>Upload Your Avatar</h4>
                 <img src="{{ showImage($user->avatar) }}" alt="{{ $user->avatar }}">
                 <input type="file" name="avatar">
                 <div class="form-group">
                   <label for="blurb">ABOUT YOU</label>
                   <textarea name="blurb" id="blurb" class="form-control"></textarea>
                   <p class="errors">{{ $errors->profile->first('blurb') }}</p>
                 </div>

                  <div class="form-group">
                     <label for="title">Twittle</label>
                     <div class="input-group">
                       <div class="input-group-addon">@</div>
                       <input class="form-control" type="text" name="twitter_id" id="twitter_id" value="{{ empty(old('twitter_id')) ? $user->twitter_id : old('twitter_id') }}">
                       <p class="errors">{{ $errors->profile->first('twitter_id') }}</p>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="title">Github Account</label>
                     <div class="input-group">
                       <div class="input-group-addon">https://github.com/</div>
                       <input class="form-control" type="text" name="github" id="github" value="{{ empty(old('github')) ? $user->github : old('github') }}">
                       <p class="errors">{{ $errors->profile->first('github') }}</p>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="title">Google plus</label>
                     <div class="input-group">
                       <div class="input-group-addon">https://plus.google.com/</div>
                       <input class="form-control" type="text" name="googleplus" id="googleplus" value="{{ empty(old('googleplus')) ? $user->googleplus : old('googleplus') }}">
                       <p class="errors">{{ $errors->profile->first('googleplus') }}</p>
                     </div>
                  </div>
                  
                  <input type="submit" value="Submit" class="btn btn-primary" />  
                </form>
              </section>  <!-- section.area-form -->
            
            </div>
          </div> 
        </div>
    </section>
</div>

@stop