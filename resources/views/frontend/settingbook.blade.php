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
                <li><a href="#">General Settings</a></li>
                <li><a href="#">Publish</a>
                    <ul>
                        <li><a href="{{route('publish_book',$book->id)}}">Publish your book</a></li>    
                        <li><a href="#">Edit title page</a></li>    
                        <li><a href="{{route('publish_sample_book',$book->id)}}">Publish your sample book</a></li>    
                    </ul>        
                </li>
                <li><a href="#">Price</a></li>
                <li>
                  <a href="#">Packages & Extras</a>
                  <ul>
                    <li><a href="#">Create a Package</a></li>
                    <li><a href="#">Create An Extra</a></li>
                  </ul>
                </li>
                <li><a href="#">Landing Page</a>
                    <ul>
                      <li><a href="#">General</a></li>
                      <li><a href="#">Social Media</a></li>
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