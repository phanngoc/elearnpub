@extends ('frontend.settingbook')
@section ('content')
<div id="extra">
<h3>Extras</h3>
<h4>Add an extra</h4>
  <form role="form" method="POST" action="">
      <div class="form-group" >
        <label for="name">Name</label>
        <input type="text" class="form-control" id="title" value="" name="name"/>
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
      <button class="btn btn-primary">Create Extra</button>
  </form>
</div>
@stop
