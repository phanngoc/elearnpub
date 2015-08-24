@extends ('frontend.settingbook')
@section ('content')

<script type="text/javascript" src="{{Asset('select2/select2.js')}}"></script>
<link rel="stylesheet" href="{{Asset('select2/select2.css')}}" charset="utf-8" />

<div id="landingpage">
  <h3>Edit Landing Page</h3>

  <form role="form" method="POST" action="{{route('update_landing_page',$book->id)}}">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>

      <div class="form-group">
        <label for="youtube_url">Youtube Url</label>
        <div class="input-group">
             <span class="input-group-addon">http://youtu.be/</span>
             <input type="text" class="form-control form-control-half" value="{{$book->youtube_url}}" name="youtube_url"/>
        </div>
      </div>
      <div class="form-group">
        <label for="vimeo_url">Vimeo Url</label>
        <div class="input-group">
             <span class="input-group-addon">http://vimeo.com/</span>
             <input type="text" class="form-control form-control-half" value="{{$book->vimeo_url}}" name="vimeo_url"/>
        </div>
      </div>
      <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <textarea type="text" name="meta_description" class="form-control" rows="5">{{$book->meta_description}}</textarea>
      </div>
      <div class="form-group">
        <label for="teaser">Teaser Text</label>
        <input type="text" name="teaser" class="form-control" value="{{$book->teaser}}"/>
      </div>
      <div class="form-group">
        <label for="custom_about_author">Custom About The Author Blurb</label>
        <textarea type="text" name="custom_about_author" class="form-control" rows="5">{{$book->custom_about_author}}</textarea>
      </div>
      <button class="btn btn-primary">Upload Book</button>
  </form>
</div>
@stop
