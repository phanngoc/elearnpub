@extends ('frontend.settingbook')
@section ('content')
<div id="package">
    <h3>Packages</h3>

    <form role="form" method="POST" action="{{route('update_package',array('id'=>$book->id,'package_id'=>$package->id))}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="book_id" value="{{$book->id}}"/>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" class="form-control" value="{{$package->name}}"/>
        </div>
        <div class="form-group">
          <label for="name">Slug</label>
          <input type="text" name="url" class="form-control" value="{{$package->url}}"/>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea type="text" name="description" class="form-control" rows="5">{{$package->description}}</textarea>
        </div>
        <div class="form-group">
          <label for="minimumprice">Minimum package price (USD)*</label>
          <div class="input-group">
               <span class="input-group-addon">$</span>
               <input type="text" class="form-control form-control-half" value="{{$package->minimumprice}}" name="minimumprice"/>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Suggested package price (USD)</label>
          <div class="input-group">
               <span class="input-group-addon">$</span>
               <input type="text" class="form-control form-control-half" value="{{$package->suggestedprice}}" name="suggestedprice"/>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Quantity</label>
          <div class="input-group">
               <span class="input-group-addon">#</span>
               <input type="text" class="form-control form-control-half" value="{{$package->quantity}}" name="quantity"/>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Include the following extras in this package</label>
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($extras as $key => $value) {
                  ?>
                    <tr>
                      <td>{{$value->name}}</td>
                      <td>{{$value->description}}</td>
                      <td><a href="{{route('edit_extra',array('id'=>$book->id,'extra_id'=>$value->id))}}"><i class="fa fa-pencil-square-o"></i></a></td>
                      <td><a href="{{route('delete_extra',array('id'=>$book->id,'package_id'=>$package->id,'extra_id'=>$value->id))}}"><i class="fa fa-times"></i></a></td>
                    </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
          <a href="{{route('extras',$book->id)}}" class="btn btn-primary">Create new extra</a>
        </div>
        <button class="btn btn-primary">Update Package</button>
    </form>
</div>
@stop
