<link rel="stylesheet" href="{{Asset('lesscss/css/below_header.css')}}" />
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
		</div>

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
		</div>
		
	</div>
</div>
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