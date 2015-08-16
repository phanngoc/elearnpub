@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/writebook.css')!!}" rel="stylesheet" type="text/css" />
<script src="{!!Asset('noty-2.3.5/js/noty/packaged/jquery.noty.packaged.js')!!}" type="text/javascript"></script>
<script type="text/javascript" src="{{ Asset('handlebars-v3.0.3.js') }}"></script>
<script type="text/javascript" src="{{ Asset('markdown.min.js') }}"></script>

<style type="text/css">
  .highlight-row{
     background-color:#D3D3D3;
  }
</style>
<section class="content-wrapper">
    <div class="content-inner">
        <div class="row inner-control-top">
          <button class="btn btn-default open-preview pull-right">Preview</button>
        </div>
        <div class="row inner-content-write">
            <div class="col-md-4">
              <div class="control">
                <div class="area-file">
                 <table class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Action</th>
                        <th>Is Sample</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                          foreach ($files as $key => $value) {
                              ?>
                                <tr <?php if($value->name == $filebook->name) echo 'class="highlight-row"';?> >
                                    <input type="hidden" value="<?php echo $value->id; ?>"/>
                                    <td><a href="{{ route('writebook',array('id'=>$value->book_id,'namefile'=>$value->name)) }}" ><?php echo $value->name;?></a></td>
                                    <td> 
                                        <div class="action">
                                           <a href="#" class="edit" onclick="return false;"><i class="fa fa-pencil-square-o"></i></a>
                                           <a href="#" class="delete" onclick="return false;"><i class="fa fa-times"></i></a>
                                        </div>
                                    </td>
                                    <td><input type="checkbox" <?php if($value->is_sample==1) echo 'checked';?> class="is_sample" /></td>
                                </tr>
                              <?php
                          }
                      ?>   
                    </tbody>
                  </table>
                </div>

                <div class="row control-primary">
                    <a href="#" class="btn btn-primary col-md-2 col-md-push-2 new-file" onclick="return false;" data-toggle="modal" data-target="#modalNewfile" >New file</a>
                </div>
              </div> <!-- .control -->
            </div>
            <div class="col-md-8">
                <div class="inner-area-write">
                    <textarea rows="40" cols="100" class="content-write"><?php echo $filebook->content; ?></textarea> 
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal preview file -->
<div id="modalPreview" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Preview</h4>
      </div>
      <div class="modal-body">
         <div class="content-preview">
           
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

<!-- data create new row file -->
<script id="rowadd-template" type="text/x-handlebars-template">
  <tr class="highlight-row">
      <input type="hidden" value="@{{ id }}" />
      <td><a href="@{{ link }}">@{{ name }}</a></td>
      <td> 
          <div class="action">
             <a href="#" class="edit" onclick="return false;"><i class="fa fa-pencil-square-o"></i></a>
             <a href="#" class="delete" onclick="return false;"><i class="fa fa-times"></i></a>
          </div>
      </td>
      <td><input type="checkbox"/></td>
  </tr>
</script>


<!-- Modal confirm create new file -->
<div id="modalNewfile" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Can you set file name ?</h4>
      </div>
      <div class="modal-body">
        <p class="label">File Name</p>
        <input name="filename" id="filename" class="form-control" /> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary accept-new-file" data-dismiss="modal">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){

       $('.open-preview').click(function(){
          $("#modalPreview").modal('show');
          var content = $('.inner-area-write .content-write').val();
          var html = markdown.toHTML(content);
          $('.content-preview').html(html);

       });

       $('.area-file').on('click','.edit',function(){
            var name = $(this).parent().parent().prev().find('a').text();
          
            $(this).parent().parent().prev().find('a').hide();
            $(this).parent().parent().prev().append('<input name="edit" value="'+name+'"/>');

            var $input = $(this).parent().parent().prev().find('input');
            $input.focus();
            $input.on('focusout',function(){
                var text = $(this).val();
                $(this).parent().find('a').html(text).show();
                // id of file need rename
                var id = $(this).parent().prev().val();

                $.ajax({
                   method : 'POST',
                   url : '{{ route("renamefile") }}',
                   data : { id : id , name : text, _token : "{{ csrf_token() }}"}
                }).done(function(response){
                    var n = noty({
                        text: 'Your file rename successfully',
                        theme: 'relax', // or 'relax'
                        type: 'success',
                        timeout: 3000,
                        killer: true
                    });

                });
                $(this).remove();
            });
       });

      // Delete file
      $('.area-file').on('click','.delete',function(){
          if(confirm("Are you sure delete file ?"))
          {
            var id = $(this).closest('td').prev().prev().val();
            var $delete = $(this);
            
            $.ajax({
                   method : 'POST',
                   url : '{{ route("removefile") }}',
                   data : { id : id , _token : "{{ csrf_token() }}"}
                }).done(function(response){
                    var n = noty({
                        text: 'Your file are deleted successfully',
                        theme: 'relax', // or 'relax'
                        type: 'success',
                        timeout: 3000,
                        killer: true
                    });
                    if ($delete.closest( "tr" ).hasClass('highlight-row'))
                    {
                        var getUrl = window.location;
                        var base_url = getUrl .protocol + "//" + getUrl.host;
                        var link = base_url+'/write/'+{{ $filebook->book_id }};
                        window.location = link;
                    }
                    else
                    {
                        $delete.closest( "tr" ).remove();
                    }
            });
          }
      });
      
      // when click button ok in modal set file name
      $('.accept-new-file').click(function(){
          var namenewfile = $('#modalNewfile').find('input').val();
          $.ajax({
                   method : 'POST',
                   url : '{{ route("newfile",$filebook->book_id) }}',
                   data : { namenewfile : namenewfile , _token : "{{ csrf_token() }}"}
                }).done(function(response){
                    var filenew = JSON.parse(response);
                    var n = noty({
                        text: 'Your file are created successfully',
                        theme: 'relax', // or 'relax'
                        type: 'success',
                        timeout: 3000,
                        killer: true
                    });
                    var source   = $("#rowadd-template").html();
                    var template = Handlebars.compile(source);
                    var getUrl = window.location;
                    var base_url = getUrl .protocol + "//" + getUrl.host;
                    filenew.link = base_url+'/write/'+filenew.book_id+'/'+filenew.name;
                    var html    = template(filenew);
                    // $('.area-file').find('tr').removeClass('highlight-row');
                    // $('.area-file').find('tbody').append(html);
                    window.location = filenew.link;
            });
      });

      $('.area-file').on('change','.is_sample',function(){
         var file_id = $(this).parent().parent().children('input').val();
        
         var isSample = 0;
         if($(this).is(":checked")) {
            isSample = 1;
         }
         $.ajax({
                   method : 'POST',
                   url : '{{ route("issamplefile") }}',
                   data : { file_id : file_id ,isSample : isSample, _token : "{{ csrf_token() }}"}
                }).done(function(response){
                   
                });
      });
      
      setInterval(function(){ 
         var content = $('.inner-area-write .content-write').val();
         saveContentAuto({{ $filebook->id }} , content);
      }, 3000);

      function saveContentAuto(file_id,content)
      {
         $.ajax({
                   method : 'POST',
                   url : '{{ route("autoSaveContent") }}',
                   data : { file_id : file_id ,content : content , _token : "{{ csrf_token() }}"}
         }).done(function(response){
                   
         });
      }
    });
</script>
@stop