@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/home.css')!!}" rel="stylesheet" type="text/css" />
<section class="content-wrapper">
    <div class="content-inner">
        <div class="row">
            <div class="col-md-4 control">

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
                                <tr <?php if($value->name == $filebook->name) echo 'style="background-color:#D3D3D3";';?> >
                                    <input type="hidden" value="<?php echo $value->id; ?>"/>
                                    <td><a href="{{ route('writebook',array('id'=>$value->book_id,'namefile'=>$value->name)) }}" ><?php echo $value->name;?></a></td>
                                    <td> 
                                        <div class="action">
                                           <a href="#" class="edit"><i class="fa fa-pencil-square-o"></i></a>
                                           <a href="#" class="delete"><i class="fa fa-times"></i></a>
                                        </div>
                                    </td>
                                    <td><input type="checkbox" <?php if($value->is_sample==1) echo 'checked';?>/></td>
                                </tr>
                              <?php
                          }
                      ?>   
                    </tbody>
                  </table>
                </div>

                <div class="row control-primary">
                    <a href="#" class="btn btn-primary col-md-2 col-md-push-2 new-file" >New file</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="inner-area-write">
                    <textarea rows="40" cols="100" class="content-write">
                        <?php 
                            echo $filebook->content;
                        ?>
                    </textarea> 
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function(){
       $('.area-file').find('.edit').on('click',function(){
            var name = $(this).parent().parent().prev().find('a').text();
          
            $(this).parent().parent().prev().find('a').hide();
            $(this).parent().parent().prev().append('<input name="edit" value="'+name+'"/>');

            var $input = $(this).parent().parent().prev().find('input');
            $input.on('focusout',function(){
                var text = $(this).val();
                $(this).parent().find('a').html(text).show();
                
                var id = $(this).parent().prev().val();
                console.log(id);
                $(this).remove();
            });
       });
    });
</script>
@stop