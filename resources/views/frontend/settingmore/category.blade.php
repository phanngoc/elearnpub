@extends ('frontend.settingbook')
@section ('content')

<script type="text/javascript" src="{{Asset('select2/select2.js')}}"></script>
<link rel="stylesheet" href="{{Asset('select2/select2.css')}}" charset="utf-8" />

<div id="percent_complete">
  <h3>Edit Categories</h3>

  <form role="form" method="POST" action="{{route('update_category',$book->id)}}">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>

      <div class="form-group">
        <label for="category">Categories</label><br/>
        <select class="category form-control haft-width" name="category[]" multiple="multiple">
            <?php
              $categoriesBook = $book->categories->pluck(['id'])->toArray();

              foreach ($categories as $key => $value) {
                ?>
                  <option value="<?php echo $value->id ?>" <?php if(in_array($value->id, $categoriesBook)) echo 'selected'; ?> ><?php echo $value->name ?></option>
                <?php
              }
            ?>
        </select>
      </div>

      <button class="btn btn-primary">Update Category</button>
  </form>
</div>
<script type="text/javascript">
  $('.category').select2();
</script>
@stop
