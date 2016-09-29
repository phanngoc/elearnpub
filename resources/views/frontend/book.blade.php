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
                <h3>Your Books</h3>
                <div class="action">
                    <div class="description">
                      You can edit your books by clicking on the  icon. You can also choose which books show up on your profile page by using the  icon. Books which are in stealth mode, embargo or not accepted will not show up, of course...
                    </div>
                    <a href="{{route('new_book')}}" class="btn btn-primary">Create Another Book</a>
                </div>
              </section>
              <section class="info-publish">
                  <h3>Published(0)</h3>
                  <div class="list-book">
                    <ul>
                      <?php
                        foreach ($bookpublish as $key => $value) {
                          ?>
                            <li>
                               <div class="wrapper-avatar">
                                <!-- $value->id is only id in book_author table not id book, $value->book_id is thing we need -->
                                 <a href="{{route('settingbook',$value->book_id)}}">
                                    <img src="{{ imageBook($value->diravatar) }}" />
                                 </a>
                               </div>
                               <div class="title">
                                 {{ $value->title }}
                               </div>
                            </li>
                          <?php
                        }
                      ?>
                    </ul>
                  </div>
              </section>
              <section class="info-publish">
                  <h3>Unpublished(0)</h3>
                  <div class="list-book">
                    <ul>
                        <?php
                          foreach ($bookunpublish as $key => $value) {
                            ?>
                              <li>
                                 <div class="wrapper-avatar">
                                   <a href="{{route('settingbook',$value->id)}}">
                                      <img src="{{ imageBook($value->diravatar) }}" />
                                   </a>
                                 </div>
                                 <div class="title">
                                   {{ $value->title }}
                                 </div>
                              </li>
                            <?php
                          }
                        ?>
                    </ul>
                  </div>
              </section>
            </div>
          </div>
        </div>
    </section>
</div>

@stop
