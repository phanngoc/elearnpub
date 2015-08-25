@extends ('frontend.settingbook')
@section ('content')

<div id="add_contributor">
  <h3>Add Contributor</h3>

  <form role="form" method="POST" action="{{route('post_add_contributor',$book->id)}}" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>

      <div class="form-group">
        <p class="description">If the contributor is author,just specify their username</p>
        <label for="custom_author_name">Username</label>
        <div class="input-group">
             <span class="input-group-addon">http://leanpub.com/u/</span>
             <input type="text" class="form-control form-control-half" name="username" value="{{ old('username') }}"/>
        </div>
        {{ $errors->cocontributor->first('username') }}
      </div>
      <p class="description">If the contributor is not a Leanpub author, please fill in the following...</p>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
        {{ $errors->cocontributor->first('name') }}
      </div>
      <div class="form-group">
        <label for="blurb">Blurb</label>
        <textarea type="text" name="blurb" class="form-control" >{{ old('blurb') }}</textarea>
        {{ $errors->cocontributor->first('blurb') }}
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" value="{{ old('email') }}" />
        {{ $errors->cocontributor->first('email') }}
      </div>
      <div class="form-group">
        <label for="twitter_id">Twitter ID</label>
        <input type="text" name="twitter_id" class="form-control" value="{{ old('twitter_id') }}" />
        {{ $errors->cocontributor->first('twitter_id') }}
      </div>
      <div class="form-group">
        <label for="github">Github</label>
        <input type="text" name="github" class="form-control" value="{{ old('github') }}"/>
        {{ $errors->cocontributor->first('github') }}
      </div>
       <div class="form-group">
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" class="form-control"/>
        {{ $errors->cocontributor->first('avatar') }}
      </div>
      <button class="btn btn-primary">Add Contributor</button>
      
  </form>
</div>

@stop
