@extends ('frontend.settingbook')
@section ('content')
<div id="list-package">
    <h3>List Package</h3>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Minimum Price</th>
          <th>Suggested Price</th>
          <th>Quantity</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($packages as $key => $value) {
            ?>
              <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->description}}</td>
                <td>{{$value->minimumprice}}</td>
                <td>{{$value->suggestedprice}}</td>
                <td>{{$value->quantity}}</td>
                <td>
                  <a href="{{route('edit_package',array('id'=>$book->id,'package_id'=>$value->id))}}"><i class="fa fa-pencil-square-o"></i></a>
                  <a href="{{route('delete_package',array('id'=>$book->id,'package_id'=>$value->id))}}" class="delete_package"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
    <a href="{{route('package',$book->id)}}" class="btn btn-primary">Create New Package</a>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.delete_package').click(function(event){
      event.preventDefault();
      if(confirm("Are you sure delete package ?"))
      {
        window.location = $(this).attr('href');
      }
    });
  });
</script>
@stop
