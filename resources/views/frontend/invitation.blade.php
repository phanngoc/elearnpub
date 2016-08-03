@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/dashboardbook.css')!!}" rel="stylesheet" type="text/css" />

<div class="content-wrapper">
    <section class="large-container">
        <div id="inner-wrapper-listbook" class="row">

          @include('frontend.author_dashboard')
    
          <div class="col-md-9">
            <div class="inner-content">
              <section class="info-top">
                <h3>Your invitation</h3>
                <div class="action">
                    <div class="description">
                      You can approve and reject request take part in bundle from people
                    </div>
                </div>
              </section>
              <section class="info-invitation">
                  <h3>Have invitation for you</h3>
                  <div class="list-book">
                    <table class="table">
                      <tr>
                        <th>Your book</th>
                        <th>Bundle Name</th>
                        <th>Author</th>
                        <th>State</th>
                      </tr>
                      <?php foreach ($bundles_res as $key => $value): ?>
                        <tr>
                          <td>{{ $value->book()->get()[0]->title }}</td>
                          <td>{{ $value->bundle()->get()[0]->title }}</td>
                          <td>{{ $value->bundle()->get()[0]->user()->get()[0]->username }}</td>
                          <?php
                            $text_accepted = ($value->accepted) ? 'Cancel Approval' : 'Approve request';
                            $accepted = ($value->accepted == 0) ? 1 : 0;
                          ?>
                          <td><a href="{{ route('responseInvitation', array('id' => $value->id, 'response' => $accepted)) }}">{{ $text_accepted }}</a></td>
                        </tr>
                      <?php endforeach ?>
                    </table>
                  </div>
              </section>  
            </div>
          </div> 
        </div>
    </section>
</div>

@stop