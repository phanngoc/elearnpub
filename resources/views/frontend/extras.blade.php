@extends ('frontend.settingbook')
@section ('content')
<script type="text/javascript" src="{{Asset('dropzone/dropzone.js')}}"></script>
<link rel="stylesheet" href="{{Asset('dropzone/dropzone.css')}}" charset="utf-8" />

<div id="extra">
<h3>Extras</h3>
<h4>Add an extra</h4>
  <form role="form" method="POST" action="{{route('upload_extra',$book->id)}}" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group" >
        <label for="name">Name</label>
        <input type="text" class="form-control" id="title" value="" name="name"/>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" class="form-control" id="description" name="description" rows="10"></textarea>
      </div>
      <div class="form-group">
        <label for="files">Files</label>
        <div class="dropzone" id="area-upload-file">
        </div>
      </div>

      <button class="btn btn-primary">Create Extra</button>
  </form>
</div>

<script type="text/javascript">
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("div#area-upload-file", {
    url: "{{route('upload_extra',$book->id)}}",
    addRemoveLinks: true,
    sending: function(file, xhr, formData) {
        // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
        console.log('co vao');
        formData.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default
    },
    removedfile : function(file)
    {
      console.log(file);
      $.ajax({
        url : "{{Asset(route('delete_extra',$book->id))}}",
        method : "GET",
        data : {filename : file.name},
        success : function(data)
        {

        }
      });
      var _ref;
      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    },
    success : function(file,response)
    {
      this.identity = response;
    },
    init : function(){
      thisDropzone = this;
       $.get('{{route("get_file_upload",$book->id)}}', function(data) {
         var result = jQuery.parseJSON(data);
         console.log(result);
           $.each(result, function(key,value){
               var mockFile = { name: value.name, size: value.size };
               thisDropzone.options.addedfile.call(thisDropzone, mockFile);
               thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "{{Asset('images/very-basic-file-icon.png')}}");
           });

       });
    }

  });
  // $("div#area-upload-file").dropzone({ url: "{{route('upload_extra',$book->id)}}" });
</script>
@stop
