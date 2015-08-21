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
    },
    success : function(file,response)
    {
      this.identity = response;
    }
    init : function(){
      this.on("addedfile", function (file) {
          // Create the remove button
          var removeButton = Dropzone.createElement("<a>Remove file</a>");

          // Capture the Dropzone instance as closure.
          var _this = this;
          // Listen to the click event
          removeButton.addEventListener("click", function (e) {
            // Make sure the button click doesn't submit the form:
            console.log('ok');
            e.preventDefault();
            e.stopPropagation();
            // Remove the file preview.
            _this.removeFile(file);
            $(this).closest('.dz-preview').remove();
            // If you want to the delete the file on the server as well,
            // you can do the AJAX request here.
          });

          // Add the button to the file preview element.
          file.previewElement.appendChild(removeButton);
      });
    }

  });
  // $("div#area-upload-file").dropzone({ url: "{{route('upload_extra',$book->id)}}" });
</script>
@stop
