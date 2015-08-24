@extends ('frontend.settingbook')
@section ('content')

<script type="text/javascript" src="{{Asset('select2/select2.js')}}"></script>
<link rel="stylesheet" href="{{Asset('select2/select2.css')}}" charset="utf-8" />

<div id="percent_complete">
  <h3>Language & Character Encoding</h3>

  <form role="form" method="POST" action="{{route('update_language',$book->id)}}">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>

      <div class="form-group">
        <label for="language">Main Language</label><br/>
        <select class="language form-control haft-width" name="language">
            <?php
              foreach ($languages as $key => $value) {
                ?>
                  <option value="<?php echo $value->id ?>" <?php if($value->id == $book->language_id) echo 'selected'; ?> ><?php echo $value->language_name ?></option>
                <?php
              }
            ?>
        </select>
      </div>

      <button class="btn btn-primary">Update Language</button>
  </form>
</div>
<script type="text/javascript">
  $('.language').select2();
</script>
@stop
