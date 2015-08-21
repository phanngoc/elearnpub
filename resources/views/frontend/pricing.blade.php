@extends ('frontend.settingbook')
@section ('content')
<div id="pricing">
    <h3>Pricing</h3>

    <form role="form" method="POST" action="{{route('post_pricing',$book->id)}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
          <label for="minimumprice">Minimum book price (USD)*</label>
          <div class="input-group">
               <span class="input-group-addon">$</span>
               <input type="text" class="form-control" value="{{ $book->price->minimumprice }}" name="minimumprice"/>
          </div>
          <div class="form-group">
              <label for="suggestedprice">Suggested book price (USD)</label>
              <div class="input-group">
                   <span class="input-group-addon">$</span>
                   <input type="text" class="form-control" value="{{ $book->price->suggestedprice }}" name="suggestedprice"/>
              </div>
          </div>
        </div>
        <button class="btn btn-primary">Update Pricing</button>
    </form>
</div>

@stop
