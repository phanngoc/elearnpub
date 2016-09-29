@extends ('frontend.settingbook')
@section ('content')
<div id="uploadtitlebook">
    <h3>Upload Title Page</h3>
    <h4>Title Page</h4>
    <?php if(strcmp($book->avatar,"") != 0) { ?>
        <img src="{{ imageBook($book->diravatar) }}" class="wrap-avatar"/>
    <?php } else { ?>
        <img src="{{Asset('images/question-mark.png')}}" class="wrap-avatar"/>
    <?php } ?>

    <form role="form" method="POST" action="{{route('post_upload_new_title',$book->id)}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
          <label for="release_note">Upload a new title page</label>
          <input type="file" name="avatar" class="btn btn-default" />
        </div>
        <button class="btn btn-primary">Upload</button>
    </form>
</div>

@stop
