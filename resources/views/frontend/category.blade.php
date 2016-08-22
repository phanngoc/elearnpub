@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/category.css')!!}" rel="stylesheet" type="text/css" />

<div class="content-wrapper">
    @include ('frontend.below_header')
    <!-- Main content -->
    <div class="inner-content-wrapper">
        <div class="content">
             <?php $index=1; ?>
              @foreach ($books as $book)
                  <?php if ($index%6==1) : ?>
                      <div class="row">
                  <?php endif; ?>

                  <div class="item col-md-2">
                      <div class="avatar-wrapper">
                          <a href="{{route('bookhome', $book->bookurl)}}"><img src="{{Asset('resourcebook/'.$book->diravatar)}}" /> </a>
                      </div>
                      <div class="content-more">
                          <p class="title">{{$book->title}}</p>
                          <span class="author"></span>
                      </div>
                  </div>

                  <?php if($index%6==0 || $index==count($books)) : ?>
                      </div>
                  <?php endif; ?>

                  <?php $index++; ?>
              @endforeach
        </div>

        <div class="pagination">
            {!! $books->render() !!}
        </div>
    </div>
</div> <!-- .content-wrapper -->

@stop
