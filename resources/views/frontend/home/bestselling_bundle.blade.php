@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/bestselling_bundle.css')!!}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ Asset('angularjs/angular.js') }}"></script>

<div class="content-wrapper">
  <div id="below-header">
    <div class="inner-below-header">
      <div class="title_header">
        <h3>Bestselling Bundles</h3>
        <div class="wrap_filter">
          <div class="dropdown">
           <p class="dropdown-toggle" data-toggle="dropdown">{{$bundleFilter[$filter]}}</p>
           <span class="caret"></span>

           <div id="filterDropdown" class="dropdown-menu">
             <ul>
                @foreach ($bundleFilter as $key => $value)
                  @if ($key == $filter)
                    <li><a href="{{route('bestselling_bundle', array('filter' => $key))}}" class="active"> {{$value}} </a></li>
                  @else
                    <li><a href="{{route('bestselling_bundle', array('filter' => $key))}}" >{{$value}}</a></li>
                  @endif
                @endforeach
             </ul>
           </div>
         </div> <!-- .dropdown -->
        </div> <!-- .wrap_filter -->
      </div> <!-- .title_header -->
    </div> <!-- .inner-below-header -->
  </div> <!-- #below-header -->

    <!-- Main content -->
    <div class="inner-content-wrapper">
        <div class="content container">
              <?php $index=1; ?>

              @foreach ($bundles as $bundle)
                  <?php if ($index%3 == 1) : ?>
                      <div class="row">
                  <?php endif; ?>

                  <div class="item col-md-4">
                      <?php
                        $avatars = json_decode($bundle->avatar);
                      ?>
                      <div class="avatar-wrapper count-{{count($avatars)}}">
                          <?php
                            foreach ($avatars as $avatar) {
                              ?>
                                <div class="cover-image">
                                  <a href="{{ route('bundle_detail', $bundle->bundleurl) }}">
                                    <img src="{{ imageBook($avatar) }}"/>
                                  </a>
                                </div>
                              <?php
                            }
                          ?>
                      </div> <!-- .avatar-wrapper -->

                      <div class="content-more">
                          <p class="title">{{ $bundle->title }}</p>
                          <span class="countbook">{{ count(json_decode($bundle->avatar)) }} books.</span>
                      </div> <!-- .content-more -->
                  </div> <!-- .item col-md-4 -->

                  <?php if($index%3==0 || $index==count($bundles)) : ?>
                  </div> <!-- .row -->
                  <?php endif; ?>

              <?php $index++; ?>
              @endforeach
        </div>

        <div class="pagination">
            {!! $bundles->render() !!}
        </div>
    </div>
</div> <!-- .content-wrapper -->

@stop
