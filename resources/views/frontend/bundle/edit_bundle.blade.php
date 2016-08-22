@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/dashboardbook.css')!!}" rel="stylesheet" type="text/css" />
<link href="{!!Asset('lesscss/css/edit_bundle.css')!!}" rel="stylesheet" type="text/css" />

<div class="content-wrapper">
    <section class="large-container">
        <div id="inner-wrapper-listbook" class="row">

          @include('frontend.author_dashboard')

          <div class="col-md-9">
            <div class="inner-content">
              <section class="info-top">
                <h3>Edit Bundle</h3>
                <div class="action">
                    <div class="description">
                      After you fill in this information and create your bundle, you will be able to add books to it. The bundle gets the same 90% - 50 cents royalty that Leanpub books do. This bundle royalty is then split up between the books in the bundle according to percentages you set. If you include other authors in your bundle, make sure you are generous with the percentages: they must approve the bundle for it to be published.
                    </div>
                    <form action="{{ route('post_edit_bundle',$bundle->id) }}" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label for="title">BUNDLE NAME</label>
                        <input name="title" class="form-control" value="{{ empty(old('title')) ? $bundle->title : old('title') }}">
                        <p class="errors">{{ $errors->bundle->first('title') }}</p>
                      </div>

                      <div class="form-group">
                         <label for="title">BUNDLE URL</label>
                         <div class="input-group">
                           <div class="input-group-addon">$</div>
                           <input class="form-control" type="text" name="bundleurl" id="bundleurl" value="{{ empty(old('bundleurl')) ? $bundle->bundleurl : old('bundleurl') }}">
                           <p class="errors">{{ $errors->bundle->first('bundleurl') }}</p>
                         </div>
                      </div>

                      <div class="form-group">
                        <label for="title">DESCRIPTION</label>
                        <textarea name="description" class="form-control">{{ empty(old('description')) ? $bundle->description : old('description') }}</textarea>
                        <p class="errors">{{ $errors->bundle->first('description') }}</p>
                      </div>

                      <div class="form-group">
                        <label for="minimum">MINIMUM BUNDLE PRICE (USD)</label>
                        <input type="number" class="form-control" name="minimum" value="{{ empty(old('minimum')) ? $bundle->minimum : old('minimum') }}" />
                        <p class="errors">{{ $errors->bundle->first('minimum') }}</p>
                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div class="addbook">
                  <h3>Add a New Book to Your Bundle</h3>
                  <div class="description">
                      Enter the URL of the book you want to add to your bundle. The primary author of this book will need to approve the request on their Dashboard page.
                  </div>
                  <form action="{{ route('add_book_to_bundle',$bundle->id) }}" method="POST">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                         <label for="bookurl">Book url</label>
                         <div class="input-group">
                           <div class="input-group-addon">/b/</div>
                           <input class="form-control" type="text" name="bookurl" id="bookurl">
                           <p class="errors">{{ $errors->book->first('bookurl') }}</p>
                         </div>
                      </div>

                      <div class="form-group">
                        <label for="royalty">Royality</label>
                        <input type="number" class="form-control" name="royalty" />
                        <p class="errors">{{ $errors->book->first('royalty') }}</p>
                      </div>

                      <button class="btn btn-primary">Submit</button>
                  </form>
                </div>

                <div class="list_book_bundle">
                  <h3>Books in Your Bundle</h3>
                  <div class="description">
                    <table class="table">
                      <tr>
                        <th>Book</th>
                        <th>Royalty</th>
                        <th>Accept</th>
                        <th>Action</th>
                      </tr>
                      @foreach($bookbundles as $bookbundle)
                        <tr>
                          <td>{{ $bookbundle->book()->get()[0]->title }}</td>
                          <td>{{ $bookbundle->royalty }}</td>
                          <td>{{ $bookbundle->accepted ? 'true' : 'false' }}</td>
                          <td>
                              <a href="{{ route('delete_book_from_bundle', array('id'=> $bundle->id, 'book_bundle_id'=> $bookbundle->id )) }}" class="text-red confirm" title="Delete">
                                 <i class="fa fa-fw fa-ban"></i>
                              </a>
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                </div> <!-- .list_book_bundle -->

                <div class="area_publish_bundle">
                  <h3>Publish your bundle</h3>
                  <div class="wrap-btn-pub">
                    <a class="btn btn-primary" href="{{route('publish_bundle', $bundle->id)}}">Publish</a>
                  </div>
                </div>
              </section>
            </div> <!-- .inner-content -->
          </div> <!-- .col-md-9 -->
        </div>
    </section>
</div>

<script type="text/javascript" src="{{ Asset('jquery-confirm/jquery.confirm.js') }}"></script>

<script type="text/javascript">
  $(".confirm").confirm({
    text: "Are you sure you want to delete this book?",
    title: "Confirmation required",
    confirm: function(button) {
      var url = $(button).attr('href');
      // console.log(url);
      window.location = url;
    },
    cancel: function(button) {
        // nothing to do
    },
    confirmButton: "Yes I am",
    cancelButton: "No",
    post: true,
    confirmButtonClass: "btn-danger",
    cancelButtonClass: "btn-default",
    dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
  });
</script>



@stop
