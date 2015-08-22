@extends ('frontend.settingbook')
@section ('content')
<div id="package">
    <h3>Packages</h3>

    <form role="form" method="POST" action="{{route('post_package',$book->id)}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="book_id" value="{{$book->id}}"/>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" class="form-control" value=""/>
        </div>
        <div class="form-group">
          <label for="name">Slug</label>
          <input type="text" name="url" class="form-control" value=""/>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea type="text" name="description" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
          <label for="minimumprice">Minimum package price (USD)*</label>
          <div class="input-group">
               <span class="input-group-addon">$</span>
               <input type="text" class="form-control form-control-half" value="" name="minimumprice"/>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Suggested package price (USD)</label>
          <div class="input-group">
               <span class="input-group-addon">$</span>
               <input type="text" class="form-control form-control-half" value="" name="suggestedprice"/>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Quantity</label>
          <div class="input-group">
               <span class="input-group-addon">#</span>
               <input type="text" class="form-control form-control-half" value="" name="quantity"/>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Include the following extras in this package</label>
        </div>
        <button class="btn btn-primary">Create Package</button>
    </form>
</div>
@stop
