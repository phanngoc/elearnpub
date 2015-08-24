@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/settingbook.css')!!}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ Asset('react/react.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/react-with-addons.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/JSXTransformer.js') }}"></script>
<script type="text/javascript" src="{{ Asset('jquery.numeric.js') }}"></script>
<script type="text/javascript" src="{{ Asset('underscore.js') }}"></script>


<link href="{!!Asset('lesscss/css/'.$linkfilecss)!!}" rel="stylesheet" type="text/css" />

<div class="content-wrapper">
    <section class="large-container">
        <div class="inner-wrapper-settingbook" class="row">
          <div class="col-md-3">
            <div class="inner-sidebar">
              <h3>Action</h3>
              <ul>
                <li><a href="{{route('settingbook',$book->id)}}">General Settings</a></li>
                <li><a href="#">Publish</a>
                    <ul>
                        <li><a href="{{route('publish_book',$book->id)}}">Publish your book</a></li>
                        <li><a href="{{route('upload_new_title',$book->id)}}">Edit title page</a></li>
                        <li><a href="{{route('publish_sample_book',$book->id)}}">Publish your sample book</a></li>
                    </ul>
                </li>
                <li><a href="{{route('pricing',$book->id)}}">Price</a></li>
                <li>
                  <a href="#">Packages & Extras</a>
                  <ul>
                    <li><a href="{{route('package',$book->id)}}">Create a Package</a></li>
                    <li><a href="{{route('extras',$book->id)}}">Create An Extra</a></li>
                    <li><a href="{{route('list_package',$book->id)}}">List Package</a></li>
                  </ul>
                </li>
                <li><a href="#">Landing Page</a>
                    <ul>
                      <li><a href="{{route('landing_page',$book->id)}}">General</a></li>
                      <li><a href="{{route('landing_page',$book->id)}}">Social Media</a></li>
                      <li><a href="{{route('percent_complete',$book->id)}}">Percent Complete</a></li>
                    </ul>
                </li>
                <li><a href="#">Settings</a>
                    <ul>
                      <li><a href="{{route('category',$book->id)}}">Categories</a></li>
                      <li><a href="{{route('language',$book->id)}}">Language & Character Encoding</a></li>
                    </ul>
                </li>
                <li><a href="#">Author</a>
                    <ul>
                      <li><a href="{{route('custom_author_name',$book->id)}}">Custom Author Name Display</a></li>
                      <li><a href="{{route('language',$book->id)}}">Language & Character Encoding</a></li>
                    </ul>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-9">
            <div class="inner-content">
              <section class="wrapper-content">
                   @yield('content')
              </section>
            </div>
          </div>
        </div>
    </section>
</div>

@stop
