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
                <h3>Your Bundles</h3>
                <div class="action">
                    <div class="description">
                      As an author, you can also create bundles of your books and other authors' books, to be sold together at a discount.
                      If you include other authors' books in your bundle, they must approve the bundle before it is live. 
                      Bundles help you and other authors sell more books together: readers love bundles, as they get a deal and as they discover related books easier!
                      Create a new bundle now!
                    </div>
                    <a href="{{route('new_bundle')}}" class="btn btn-primary">Create New Bundle</a>
                </div>
              </section>
              <section class="info-publish">
                  <h3>Bundles You've Created</h3>
                  <div class="list-bundle">
                    <table class="table">
                      <tr>
                        <th>Name</th>
                        <th>Minimum</th>
                        <th>Action</th>
                      </tr>
                      <?php  
                        foreach ($bundles as $key => $value) {
                          ?>
                          <tr>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->minimum }}</td>
                            <td>
                              <a href="{{ route('edit_bundle',$value->id) }}" class="text-blue" title="Edit">
                                 <i class="fa fa-fw fa-edit"></i>
                              </a>
                              <a href="{{ route('delete_bundle',$value->id) }}" class="text-red confirm" title="Delete">
                                 <i class="fa fa-fw fa-ban"></i>
                              </a>
                            </td>
                          </tr>  
                          <?php
                        }
                      ?>
                    </table>
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
    text: "Are you sure you want to delete this bundle ?",
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