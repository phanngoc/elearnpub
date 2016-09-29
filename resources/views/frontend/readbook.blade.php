@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/readbook.css')!!}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ Asset('markdown.min.js') }}"></script>

<div class="content-wrapper">

    <!-- Main content -->
    <section class="large-container">
        <div id="inner-wrapper-readbook">
          <div class="row">
            <header>
                <div class="wrap-avatar">
                  <img src="{{ imageBook($book->diravatar) }}" alt="">
                </div>
                <div class="wrap-title">
                  <h3>{{ $book->title }}</h3>
                </div>
            </header>
           </div> <!-- .row -->

            <div class="content">
              <div class="inner-content">
                 <div id="content-book"></div>
                 <div class="hidden" id="content-book-orignal">{{ $contentCombile }}</div>
              </div>
            </div>

        </div> <!-- #inner-wrapper-readbook -->
    </section>
</div>

<script type="text/javascript">
  $(document).ready(function(){
      var contentbook = $('#content-book-orignal').html();
      var html = markdown.toHTML(contentbook);
      $('#content-book').html(html);
  });
</script>

@stop
