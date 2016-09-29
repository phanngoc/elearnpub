@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<style type="text/css">
   .inner-content-wrapper{
        border-top: 1px solid #b7b7b7;
        box-shadow: -2px -5px 57px #c3bfbf;
   }
   .inner-content-wrapper .content .row .item{
        height: 280px;
        margin-top: 20px;
   }
   .inner-content-wrapper .content .row .item .title{
        display: block;
        text-align: center;
        font-family: "Varela Round";
        font-style: normal;
        font-weight: 600;
        word-wrap: break-word;
        font-size: 17px;
   }
</style>

<link href="{!!Asset('lesscss/css/category.css')!!}" rel="stylesheet" type="text/css" />
<div class="content-wrapper">
    @include ('frontend.below_header')
    <!-- Main content -->
    <div class="inner-content-wrapper">
        <h3>Search for key word :"{{$keyword}}"</h3>
        <div class="content">
               <?php $index=1; ?>
                @foreach ($books as $book)
                    <?php if($index%6==1) : ?>
                        <div class="row">
                    <?php endif; ?>

                    <div class="item col-md-2">
                        <div class="avatar-wrapper">
                            <a href="{{route('bookhome',$book->bookurl)}}"><img src="{{imageBook($book->diravatar)}}" width="178" height="235" /> </a>
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
</div>


<script type="text/javascript">

</script>
@stop
