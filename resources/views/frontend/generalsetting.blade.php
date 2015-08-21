@extends ('frontend.settingbook')
@section ('content')
<h3>General Setting</h3> 
<form role="form" method="POST" action="{{ route('postsettingbook',$book->id) }}">
    <div class="form-group" >
      <label for="title">Book title</label>
      <input type="text" class="form-control" id="title" value="{{$book->title}}" name="booktitle"/>
    </div>
    <div class="form-group">
      <label for="subtitle">Book subtitle</label>
      <input type="text" class="form-control" id="subtitle" value="{{$book->subtitle}}" name="subtitle"/>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea type="text" class="form-control" id="description" name="description" rows="10">{{$book->description}}</textarea>
    </div>
    <div class="form-group">
      <label for="thankyoumessage">Thank you message</label>
        <textarea type="text" class="form-control" id="thankyoumessage">{{$book->thankyoumessage}}</textarea>
    </div>
    <div class="form-group">
      <label for="copyright">Copyright</label>
      <input type="text" class="form-control" id="copyright" value="{{$book->copyright}}"/>
    </div>
    <button class="btn btn-primary">Update book</button>  
</form>
@stop