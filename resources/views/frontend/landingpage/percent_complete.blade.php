@extends ('frontend.settingbook')
@section ('content')

<script type="text/javascript" src="{{Asset('select2/select2.js')}}"></script>
<link rel="stylesheet" href="{{Asset('select2/select2.css')}}" charset="utf-8" />

<div id="percent_complete">
  <h3>Edit Percent Complete</h3>

  <form role="form" method="POST" action="{{route('update_percent_complete',$book->id)}}">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>

      <div class="form-group">
        <label for="progress">Percent Complete</label>
        <input type="text" name="progress" class="form-control" value="{{$book->progress}}"/>
      </div>

      <button class="btn btn-primary">Update Book</button>
  </form>
</div>
@stop
