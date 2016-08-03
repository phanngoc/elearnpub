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
use App\Models\Bundle;
use App\Models\BookBundle;
use App\Models\BookAuthor;

class BundleController extends Controller
{
    /**
     * Show page list bundle.
     * @return [type] [description]
     */
    public function bundles() {
        $bundles = User::find(Auth::user()->id)->bundles()->get();
        return view('frontend.bundle.list_bundle',compact('bundles'));
    }

    /**
     * Page to create new bundle.
     * @return [type] [description]
     */
    public function new_bundle() {
    	return view('frontend.bundle.new_bundle');
    }

    /**
     * Page save data post.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postNewBundle(Request $request) {
    	$validator = Validator::make($request->all(),[
            'title' => 'required',
            'bundleurl' => 'required',
            'minimum' => 'required|numeric',
        ]);

        if($validator->fails())
        {
          return redirect()->route('new_bundle')->withErrors($validator,'newbundle')->withInput();  
        }

        $bundle = Bundle::addNewBundle($request->all());
        return redirect()->route('bundles');
    }

    /**
     * Edit bundle 
     * @return [type] [description]
     */
    public function editBundle($id) {
    	$bundle = Bundle::find($id);
    	$bookbundles = BookBundle::where('bundle_id',$id)->get();

    	return view('frontend.bundle.edit_bundle',compact('bundle','bookbundles'));
    }

    /**
     * Page save update data post.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postUpdateBundle(Request $request,$id) {
    	$validator = Validator::make($request->all(),[
            'title' => 'required',
            'bundleurl' => 'required',
            'minimum' => 'required|numeric',
        ]);

        if($validator->fails())
        {
          return redirect()->route('edit_bundle',$id)->withErrors($validator,'bundle')->withInput();  
        }

        $bundle = Bundle::updateBundle($request->all(),$id);
        return redirect()->route('edit_bundle',$id);
    }

    /**
     * Add new book to bundle.
     * @param Request $request [description]
     * @param [type]  $id      [description]
     */
    public function addNewBookToBundle(Request $request, $bundleid) {
    	$validator = Validator::make($request->all(),[
            'bookurl' => 'required',
            'royalty' => 'required|numeric',
        ]);

        if($validator->fails())
        {
          return redirect()->route('edit_bundle',$bundleid)->withErrors($validator,'bundle')->withInput();  
        }

    	$bookid = Book::where('bookurl',$request->input('bookurl'))->first()->id;
    	$accepted = 0;

    	if (BookAuthor::checkAuthorAndMain(Auth::user()->id, $bookid)) {
    		$accepted = 1;
    	}

    	BookBundle::create([
    		'book_id' => $bookid,
    		'bundle_id' => $bundleid,
    		'royalty' => $request->input('royalty'),
    		'accepted' => $accepted
    	]);
    	return redirect()->route('edit_bundle',$bundleid);
    }

    /**
     * [deleteBookFromBundle description]
     * @param  Request $request  [description]
     * @param  [type]  $bundleid [description]
     * @return [type]            [description]
     */
    public function deleteBookFromBundle(Request $request, $bundleid, $bookBundleId) {
        BookBundle::find($bookBundleId)->delete();
        return redirect()->route('edit_bundle',$bundleid);
    }

    /**
     * [deleteBundle description]
     * @param  Request $request [description]
     * @param  [type]  $bundleid  Bundle need delete
     * @return [type]           [description]
     */
    public function deleteBundle(Request $request, $bundleid) {
        Bundle::deleteBundleAndRelation($bundleid);
        return redirect()->route('bundles');
    }
}
