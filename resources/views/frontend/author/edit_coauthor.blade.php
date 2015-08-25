@extends ('frontend.settingbook')
@section ('content')

<div id="edit_coauthor">
  <h3>Edit Co-Author</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Username</th>
        <th>Royalty</th>
        <th>Primary Author</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach ($infoCoAuthor as $key => $value) {
          ?>
            <tr>
              <td>{{$value->objAuthor->lastname." ".$value->objAuthor->firstname}}</td>
              <td>{{$value->objAuthor->username}}</td>
              <td>{{$value->royalty}}</td>
              <td>@if ($value->is_main) 
                    Yes
                  @else 
                    No 
                  @endif  
              </td>
              <td>@if ($value->is_accepted) 
                    Accepted
                  @else 
                    Pending 
                  @endif  
              </td>
              <td>
                @if (!$value->is_main)
                  <a href="{{route('delete_coauthor',array('id'=>$book->id,'author_id'=>$value->author_id))}}" class="remove">Remove Co-Author</a>
                @endif
              </td>
            </tr>
          <?php
        }
        ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.remove').click(function(event){
      event.preventDefault();
      if(confirm("Are you sure remove co-author ?"))
      {
        window.location = $(this).attr('href');
      }
    });
  });
</script>
@stop
