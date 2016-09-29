@extends ('frontend.settingbook')
@section ('content')
<div id="package" ng-app="package" ng-controller="packageController">
    <h3>Packages</h3>

    <form role="form" method="POST" action="{{route('post_package',$book->id)}}" name="packageForm">

        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="book_id" value="{{$book->id}}"/>

        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" class="form-control" ng-model="name" value="" required ng-minlength="3" ng-maxlength="255" ng-change="generateUrlFromName()"/>
          <div ng-messages="packageForm.name.$error" ng-show="packageForm.name.$invalid && !packageForm.name.$pristine">
              <p ng-message="minlength">Your pakage name is too short.</p>
              <p ng-message="required">Your pakage name is required.</p>
              <p ng-message="maxlength">Your pakage name is not longer 255 character.</p>
          </div>
        </div>

        <div class="form-group">
          <label for="name">Slug</label>
          <input type="text" name="url" class="form-control" ng-model="url" value="" required min-length="3" max-maxlength="8"/>
          <div ng-messages="packageForm.url.$error" ng-show="packageForm.url.$invalid && !packageForm.url.$pristine">
              <p ng-message="minlength">Your url is too short.</p>
              <p ng-message="required">Your url is required.</p>
              <p ng-message="maxlength">Your url is not longer 8 character.</p>
          </div>
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea type="text" name="description" class="form-control" rows="5"></textarea>
        </div>

        <div class="form-group">
          <label for="minimumprice">Minimum package price (USD)*</label>
          <div class="input-group">
               <span class="input-group-addon">$</span>
               <input type="number" class="form-control form-control-half" ng-model="minimumprice" value="" name="minimumprice" required/>
          </div>
          <div ng-messages="packageForm.minimumprice.$error" ng-show="packageForm.minimumprice.$invalid && !packageForm.minimumprice.$pristine">
              <p ng-message="required">Your minimum price is required.</p>
          </div>
        </div>

        <div class="form-group">
          <label for="description">Suggested package price (USD)</label>
          <div class="input-group">
               <span class="input-group-addon">$</span>
               <input type="number" class="form-control form-control-half" ng-model="suggestedprice" value="" name="suggestedprice" required/>
          </div>
          <div ng-messages="packageForm.suggestedprice.$error" ng-show="packageForm.suggestedprice.$invalid && !packageForm.suggestedprice.$pristine">
              <p ng-message="required">Your suggested price is required.</p>
          </div>
        </div>

        <div class="form-group">
          <label for="description">Quantity</label>
          <div class="input-group">
               <span class="input-group-addon">#</span>
               <input type="number" class="form-control form-control-half" ng-model="quantity" value="" name="quantity"/>
          </div>
          <div ng-messages="packageForm.quantity.$error" ng-show="packageForm.quantity.$invalid && !packageForm.quantity.$pristine">
              <p ng-message="required">Your quantity is required.</p>
          </div>
        </div>

        <div class="form-group">
          <label for="description">Include the following extras in this package</label>
        </div>

        <button class="btn btn-primary">Create Package</button>
    </form>
</div>

<script type="text/javascript">
  var app = angular.module('package', ['ngMessages']);
  app.controller('packageController', function($scope) {
    $scope.generateUrlFromName = function() {
      if (typeof $scope.name !== "undefined") {
        $scope.url = $scope.name.toString().toLowerCase()
                  .replace(/\s+/g, '-')           // Replace spaces with -
                  .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                  .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                  .replace(/^-+/, '')             // Trim - from start of text
                  .replace(/-+$/, '');            // Trim - from end of text
      }
    }
  });
</script>
@stop
