<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Book;
use Validator;
use Zipper;
use App\Http\Controllers\Controller;
use Auth;
use File;
use App\Models\BookBundle;
use App\Models\BookAuthor;
use App\Models\Bundle;

class ProfileController extends Controller
{
    /**
     * Show page your profile
     * @return [type] [description]
     */
    public function index() {
        $user = Auth::user();
        return view('frontend.profile',compact('user'));
    }

    /**
     * Post data update profile
     * @return [type] [description]
     */
    public function postProfile(Request $request) {
    	$id = Auth::user()->id;
    	$validator = Validator::make($request->all(),[
          'avatar' => 'image',
      ]);

      if($validator->fails())
      {
        return redirect()->route('profile')->withErrors($validator,'profile')->withInput();  
      }

      $user = User::find($id);

      $fileAvatar = $request->file('avatar');

	    if ($fileAvatar->isValid()) {
	    	$destinationPath = 'avatar';
	     	$filename = str_random(10).md5(time()).'.'.$fileAvatar->getClientOriginalExtension();
	     	
      	$fileAvatar->move($destinationPath, $filename);
      	if (File::exists(base_path().'/public/avatar/'.$user->avatar)) {
    		  File::delete(base_path().'/public/avatar/'.$user->avatar);
    	  }
	    	$user->update(['avatar' => $filename]);
	    }	
	    
    	$user->update([
    		'blurb' => $request->input('blurb'),
    		'twitter_id' => $request->input('twitter_id'),
    		'github' => $request->input('github'),
    		'googleplus' => $request->input('googleplus')
    	]);
      	
      return redirect()->route('profile');
    }

    /**
     * Page show invitation to let people accept it.
     * @return [type] [description]
     */
    public function invitation() {
        $authorId = Auth::user()->id;
        $bookbundles = BookBundle::all();
        $bundles_res = array();
        foreach ($bookbundles as $key => $value) {
          if (BookAuthor::checkAuthorAndMain($authorId, $value->bundle_id)) {
            array_push($bundles_res, $value);
          }
        }
        return view('frontend.invitation', compact('bundles_res'));
    }

    /**
     * [responseInvitation description]
     * @param  [type] $bookBundleId [description]
     * @param  [type] $response [description]
     * @return [type]           [description]
     */
    public function responseInvitation($bookBundleId, $response) {
        BookBundle::find($bookBundleId)->update(['accepted' => $response]);
        return redirect(route('invitation'));
    }

}
