@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/dashboardbook.css')!!}" rel="stylesheet" type="text/css" />
<link href="{!!Asset('lesscss/css/list_bundle.css')!!}" rel="stylesheet" type="text/css" />

<div class="content-wrapper">
    <section class="large-container">
        <div id="inner-wrapper-listbook" class="row">

          @include('frontend.author_dashboard')
          
          <div class="col-md-9">
            <div class="inner-content">
              <section class="info-top">
                <h3>New Bundle</h3>
                <div class="action">
                    <div class="description">
                      After you fill in this information and create your bundle, you will be able to add books to it. The bundle gets the same 90% - 50 cents royalty that Leanpub books do. This bundle royalty is then split up between the books in the bundle according to percentages you set. If you include other authors in your bundle, make sure you are generous with the percentages: they must approve the bundle for it to be published.
                    </div>
                    <form action="{{ route('post_new_bundle') }}" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label for="title">BUNDLE NAME</label>
                        <input name="title" class="form-control">
                        <p class="errors">{{ $errors->newbundle->first('title') }}</p>
                      </div>
                      
                      <div class="form-group">
                         <label for="title">BUNDLE URL</label>
                         <div class="input-group">
                           <div class="input-group-addon">$</div>
                           <input class="form-control" type="text" name="bundleurl" id="bundleurl" value="{{ old('bundleurl') }}">
                           <p class="errors">{{ $errors->newbundle->first('bundleurl') }}</p>
                         </div>
                      </div>
        
                      <div class="form-group">
                        <label for="title">DESCRIPTION</label>
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                        <p class="errors">{{ $errors->newbundle->first('description') }}</p>
                      </div>

                      <div class="form-group">
                        <label for="minimum">MINIMUM BUNDLE PRICE (USD)</label>
                        <input type="number" class="form-control" name="minimum" value="{{ old('minimum') }}" />
                        <p class="errors">{{ $errors->newbundle->first('minimum') }}</p>
                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
              </section>
            </div> <!-- .inner-content -->
          </div> <!-- .col-md-9 -->
        </div>
    </section>
</div>

@stop