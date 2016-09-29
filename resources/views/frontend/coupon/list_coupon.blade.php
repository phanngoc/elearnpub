@extends ('frontend.settingbook')
@section ('content')

<div id="list_coupon">
  <h3>List coupon</h3>

  <div class="content">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Coupon code</th>
          <th>Coupon note</th>
          <th>Number</th>
          <th>Unit</th>
          <th>Limit</th>
          <th>Is active</th>
          <th>Start date</th>
          <th>End date</th>
          <th>Active</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($coupons as $coupon)
          <tr>
            <td>{{$coupon->coupon_code}}</td>
            <td>{{$coupon->coupon_note}}</td>
            <td>{{$coupon->number}}</td>
            <td>{{$coupon->unit}}</td>
            <td>{{$coupon->limitcount}}</td>
            <td>{{$coupon->is_actived ? 'true' : 'false'}}</td>
            <td>{{$coupon->start_date}}</td>
            <td>{{$coupon->end_date}}</td>
            <td>
              <a href="{{route('edit_coupon', array('id' => $book->id, 'coupon_id' => $coupon->id))}}">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
              <a href="{{route('post_delete_coupon', array('id' => $book->id, 'coupon_id' => $coupon->id))}}"
                 data-method="POST" class="delete_coupon" data-token="{{csrf_token()}}">
                <i class="fa fa-times" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div> <!-- .content -->
</div> <!-- #list_coupon -->

<script type="text/javascript">
  $(document).ready(function(){
    $('.delete_coupon').click(function(e) {
      e.preventDefault();
      if (confirm("Are you sure to delete coupon ?")) {
        var url = $(this).attr('href');
        var method = $(this).data('method');
        var token = $(this).data('token');
        $.ajax({
          url : url,
          method : method,
          data : {'_token' : token}
        }).done(function(response) {
          location.reload();
        });
      }
    });
  });
</script>
@stop
