@extends ('frontend.settingbook')
@section ('content')
<h3>General Setting</h3>

<form role="form" method="POST" action="{{ route('postsettingbook',$book->id) }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="form-group" >
      <label for="title">Book title</label>
      <input type="text" class="form-control" id="title" value="{{$book->title}}" name="title"/>
      <?php echo $errors->first('title', '<p class="errors">:message</p>'); ?>
    </div>
    <div class="form-group">
      <label for="subtitle">Book subtitle</label>
      <input type="text" class="form-control" id="subtitle" value="{{$book->subtitle}}" name="subtitle"/>
      <?php echo $errors->first('subtitle', '<p class="errors">:message</p>'); ?>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea type="text" class="form-control" id="description" name="description" rows="10">{{$book->description}}</textarea>
      <?php echo $errors->first('description', '<p class="errors">:message</p>'); ?>
    </div>
    <div class="form-group">
      <label for="thankyoumessage">Thank you message</label>
      <textarea type="text" class="form-control" id="thankyoumessage" name="thankyoumessage">{{$book->thankyoumessage}}</textarea>
      <?php echo $errors->first('thankyoumessage', '<p class="errors">:message</p>'); ?>
    </div>
    <div class="form-group">
      <label for="copyright">Copyright</label>
      <input type="text" class="form-control" id="copyright" name="copyright" value="{{$book->copyright}}"/>
      <?php echo $errors->first('copyright', '<p class="errors">:message</p>'); ?>
    </div>
    <button class="btn btn-primary">Update book</button>
</form>
@stop
