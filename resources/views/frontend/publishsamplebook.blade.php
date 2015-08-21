@extends ('frontend.settingbook')
@section ('content')
<h3>Publish Sample - The next book</h3> 
<h4>Just Publish My PDF Book Sample</h4>
<p>If you click "Publish My PDF Sample Book", your book will remain unpublished, but visitors to your book's public page will be able to click a link to download a free PDF copy of your sample book (this will show up as a 'Sample PDF' link in the top section your public page). The sample PDF is produced from the files listed in 'Sample.txt' in your book's 'manuscript' folder.

If you want to publish an updated version of your book sample, then you have to click the "Publish My PDF Sample Book" button again.

We encourage all Leanpub authors to publish while their books are still in-progress, so from our perspective, if you have enough for a sample, you probably have enough to publish and start creating a community of readers. However, we understand that for some publishing projects, it is useful to offer a sample of the book before publishing for the first time, which is why we made this feature.</p>   
<form role="form" method="POST" action="{{ route('post_publish_sample_book',$book->id) }}">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
<div class="form-group">
    
    <button class="btn btn-primary">
        <?php if($book->is_publish_sample) 
            {
                echo "Unpublish sample book";   
            }
            else{
                echo "Publish sample book"; 
            }
        ?>
    </button>  
</form>
@stop