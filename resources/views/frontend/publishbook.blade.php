@extends ('frontend.settingbook')
@section ('content')
<h3>Publish</h3> 
<form role="form" method="POST" action="{{route('post_publish_book',$book->id)}}">
    <div class="info-more">When you publish your book for the first time, we will email the prospective readers that signed up to be notified when your book was published. You may optionally include a personal message to them below.</div>

    <div class="form-group">
      <label for="release_note">RELEASE NOTES</label>
      <textarea type="text" class="form-control" id="release_note" name="release_note" rows="10">{{$book->release_note}}</textarea>
    </div>
    
    <button class="btn btn-primary">Publish book</button>  
</form>
<div class="info-bottom">Clicking this button will publish your book for the first time and make it available for purchase. Don't hesitate to publish! You can update your book as often as you like, and your readers will get free updates.</div>
@stop