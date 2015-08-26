@extends ('frontend.settingbook')
@section ('content')

<div id="add_coauthor">
  <h3>Edit Contributors</h3>
  <div class="content">
      <table class="table">
         <thead>
           <tr>
             <th>Name</th>
             <th>Action</th>
           </tr>
         </thead> 
         <tbody>
           @foreach ($contributors as $contri)
            <tr>
              <td>{{$contri->lastname." ".$contri->firstname}}</td>
              <td>
                <a href="{{route('show_edit_contributor',array('id'=>$contri->book_id,'author_id'=>$contri->author_id)) }}">Edit</a>
                <a href="{{route('delete_contributor',array('id'=>$contri->book_id,'author_id'=>$contri->author_id)) }}">Remove</a>
              </td>
            </tr>
           @endforeach
         </tbody>
      </table>
  </div>
</div>

@stop
