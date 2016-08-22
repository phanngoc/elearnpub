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
     * Book model.
     *
     * @var Filebook class
     */
    protected $book;

    /**
     * BookBundle model.
     *
     * @var Filebook class
     */
    protected $bookBundle;

    /**
     * User model.
     *
     * @var User class
     */
    protected $user;

    /**
     * Construct
     *
     * @param BookBundle $book
     * @param User $user
     */
    public function __construct(BookBundle $bookbundle, User $user, Book $book)
    {
        $this->bookbundle = $bookbundle;
        $this->user = $user;
        $this->book = $book;
    }

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
        return redirect()->route('profile')->withErrors($validator, 'profile')->withInput();
      }

      $user = $this->user->find($id);

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
        $bookbundles = $this->bookbundle->all();
        $bundlesRes = array();

        foreach ($bookbundles as $key => $value) {
          if (BookAuthor::checkAuthorAndMain($authorId, $value->bundle_id)) {
            array_push($bundlesRes, $value);
          }
        }
        return view('frontend.invitation', compact('bundles_res'));
    }

    /**
     * Response to invitation.
     * @param  [int] $bookBundleId [description]
     * @param  [type] $response [description]
     * @return [type]           [description]
     */
    public function responseInvitation($bookBundleId, $accepted) {
        $this->bookbundle->find($bookBundleId)->update(['accepted' => $accepted]);
        return redirect(route('invitation'));
    }

    /**
     * Show profile page of author.
     */
    public function profileAuthor($authorUsername) {
        $author = $this->user->where('username', $authorUsername)->first();
        $bookUnpublish = $author->bookUnPublish()->get();
        $bookPublish = $author->bookPublish()->get();
        return view('frontend.author.profile_author', compact('author', 'bookUnpublish', 'bookPublish'));
    }

    /**
     * Logout.
     */
    public function logout() {
        Auth::logout();
        return redirect()->intended();
    }

}
