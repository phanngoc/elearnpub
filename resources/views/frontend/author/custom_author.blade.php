@extends ('frontend.settingbook')
@section ('content')


<div id="percent_complete">
  <h3>Custom Authors</h3>
  <h4>Edit my name on this book</h4>
  <form role="form" method="POST" action="{{route('update_custom_author_name',$book->id)}}">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>

      <div class="form-group">
        <label for="custom_author_name">Name</label><br/>
        <input type="text" name="custom_author_name" value="{{$book->custom_author_name}}" class="form-control haft-width"/>
      </div>

      <button class="btn btn-primary">Change Name</button>
  </form>
</div>
@stop
