<link rel="stylesheet" href="{{Asset('lesscss/css/bestselling_below_header.css')}}" />

<div id="below-header">
	<div class="inner-below-header">
		<div class="language">
			<h4><?php if(isset($language)) { echo $language->language_name; } else { echo 'ALL LANGUAGES'; } ?></h4>
			<div class="sub-language">
				<div class="inner-sub-language">
					<ul>
							<li><a href="javascript:" class="select_lang" data-langid="all">All Languages</a></li>
						@foreach ($languages as $lang)
						  <li><a href="javascript:" class="select_lang" data-langid="{{$lang->id}}">{{ $lang->language_name }}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
		</div> <!-- .language -->

		<div class="category">
			<h4><?php if(isset($category)) { echo $category->name; } else { echo 'ALL CATEGORIES'; } ?></h4>
			<div class="sub-category">
				<div class="inner-sub-category">
					<ul>
						<li><a href="javascript:" class="select_cate" data-cateid="all">All Categories</a></li>
						@foreach ($categories as $cate)
						<li><a href="javascript:" class="select_cate" data-cateid="{{$cate->id}}">{{ $cate->name }}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
		</div> <!-- .category -->

    <div class="title_header">
      <h3>Bestselling Books</h3>
      <div class="wrap_filter">
        <div class="dropdown">
         <p class="dropdown-toggle" data-toggle="dropdown">This Week's Best Sellers</p>
         <span class="caret"></span>

         <div id="filterDropdown" class="dropdown-menu">
           <ul>
              @foreach ($bookFilter as $key => $value)
                @if ($key == $filter)
                  <li><a href="{{route('bestselling', array('filter' => $key, 'cate_id' => is_null($category) ? 'all' : $category->id, 'language_id' => is_null($language) ? 'all' : $language->id))}}" class="active"> {{$value}} </a></li>
                @else
                  <li><a href="{{route('bestselling', array('filter' => $key, 'cate_id' => is_null($category) ? 'all' : $category->id, 'language_id' => is_null($language) ? 'all' : $language->id))}}" >{{$value}}</a></li>
                @endif
              @endforeach
           </ul>
         </div>
       </div> <!-- .dropdown -->
      </div> <!-- .wrap_filter -->
    </div>

	</div> <!-- .inner-below-header -->
</div> <!-- #below-header -->

<script>
	$(document).ready(function(){
		$('.language>h4').click(function(){
			$('.sub-language').slideToggle(100);
		});

		$("body").click(function (e) {
		    var target = $(e.target);
		  	if(!target.is('.language>h4')){
		  		$('.sub-language').slideUp(100);
		  	}
		  	if(!target.is('.category>h4')){
		  		$('.sub-category').slideUp(100);
		  	}
		});

		$('.category>h4').click(function(){
			$('.sub-category').slideToggle(100);
		});

		var url = window.location.href;

		$('.select_lang').click(function(){
			var langid = $(this).data('langid');
			if (url.search(/lang\/(\d+|all)/) == -1) {
			  url += 'cate/all/lang/'+langid;
			  window.location.href = url;
			}
			url = url.replace(/lang\/(\d+|all)/, "lang/"+langid);
			console.log(url);
			window.location.href = url;
		});

		$('.select_cate').click(function(){
			var cateid = $(this).data('cateid');
			if (url.search(/cate\/(\d+|all)/) == -1) {
			  url += 'cate/'+cateid+'/lang/all';
			  window.location.href = url;
			}
			url = url.replace(/cate\/(\d+|all)/, "cate/"+cateid);
			console.log(url);
			window.location.href = url;
		});
	});
</script>
