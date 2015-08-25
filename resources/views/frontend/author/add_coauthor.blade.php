@extends ('frontend.settingbook')
@section ('content')

<div id="add_coauthor">
  <h3>Add Co-Author</h3>

  <form role="form" method="POST" action="{{route('post_add_coauthor',$book->id)}}">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>

      <div class="form-group">
        <label for="custom_author_name">Username</label>
        <div class="input-group">
             <span class="input-group-addon">http://leanpub.com/u/</span>
             <input type="text" class="form-control form-control-half" name="username"/>
        </div>
        {{ $errors->coauthor->first('username') }}
      </div>
      <div class="form-group">
        <label for="custom_author_name">Royalty %</label>
        <input type="text" name="royalty" class="form-control"/>
        {{ $errors->coauthor->first('royalty') }}
      </div>
      <div class="form-group">
        <label for="custom_author_name">A Message To The Author (Optional)</label>
        <textarea type="text" name="message" class="form-control"></textarea>
        {{ $errors->coauthor->first('message') }}
      </div>
      <button class="btn btn-primary">Add Co-Author</button>
      
  </form>
</div>

@stop
