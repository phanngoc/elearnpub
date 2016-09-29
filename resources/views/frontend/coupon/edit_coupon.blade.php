@extends ('frontend.settingbook')
@section ('content')

<div id="add_coupon">
  <h3>Edit Coupon</h3>
  <script type="text/javascript" src="{{Asset('bower_resources/datetimepicker/build/jquery.datetimepicker.full.js')}}"></script>
  <link rel="stylesheet" href="{{ Asset('bower_resources/datetimepicker/build/jquery.datetimepicker.min.css') }}" media="screen" title="no title" />

  <form role="form" method="POST" action="{{route('post_edit_coupon', array('book_id' => $book->id, 'coupon_id' => $coupon->id)) }}">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>

      <div class="form-group">
        <label for="coupon_code">Coupon Code</label>
        <input type="text" class="form-control" name="coupon_code" value="{{ old('coupon_code') ? old('coupon_code') : $coupon->coupon_code }}"/>
        {{ $errors->first('coupon_code') }}
      </div>

      <div class="form-group">
        <label for="coupon_note">Coupon Note</label>
        <input type="text" class="form-control" name="coupon_note" value="{{ old('coupon_note') ? old('coupon_note') : $coupon->coupon_note }}"/>
        {{ $errors->first('coupon_note') }}
      </div>

      <div class="form-group">
        <label for="number">Number</label>
        <input type="number" class="form-control" name="number" value="{{ old('number') ? old('number') : $coupon->number }}"/>
        {{ $errors->first('number') }}
      </div>

      <div class="form-group">
        <label for="unit">Unit</label>
        <select class="form-control" name="unit">
          <option value="$" {{ $coupon->unit == '$' ? 'selected' : '' }}>$</option>
          <option value="%" {{ $coupon->unit == '%' ? 'selected' : '' }}>%</option>
        </select>
        {{ $errors->first('unit') }}
      </div>

      <div class="form-group">
        <label for="limitcount">Limit</label>
        <input type="number" class="form-control" name="limitcount" value="{{ old('limitcount') ? old('limitcount') : $coupon->limitcount }}" />
        {{ $errors->first('limitcount') }}
      </div>

      <div class="form-group">
        <label for="number">Is active</label>
        <input type="checkbox" name="is_actived" value="1" {{ old('is_actived') ? 'checked' : $coupon->is_actived ? 'checked' : '' }}/>
        {{ $errors->first('is_actived') }}
      </div>

      <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="text" name="start_date" class="form-control" value="{{ old('start_date') ? old('start_date') : $coupon->start_date}}" />
        {{ $errors->first('start_date') }}
      </div>

      <div class="form-group">
        <label for="end_date">End Date</label>
        <input type="text" name="end_date" class="form-control" value="{{ old('end_date') ? old('end_date') : $coupon->end_date }}" />
        {{ $errors->first('end_date') }}
      </div>

      <button class="btn btn-primary">Update coupon</button>

  </form>

  <script type="text/javascript">
    $('input[name="start_date"]').datetimepicker({
        format:'Y-m-d H:i:s'
    });

    $('input[name="end_date"]').datetimepicker({
        format:'Y-m-d H:i:s'
    });
  </script>

</div>

@stop
