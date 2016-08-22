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
use App\Models\Popularity;

class BundleController extends Controller
{

    /**
     * Book model.
     *
     * @var Book class
     */
    protected $book;

    /**
     * BookBundle model.
     *
     * @var Price class
     */
    protected $bookbundle;

    /**
     * User model.
     *
     * @var User class
     */
    protected $user;

    /**
     * Bookauthor model.
     *
     * @var Bookauthor class
     */
    protected $bookauthor;

    /**
     * Bundle model.
     *
     * @var Bundle class
     */
    protected $bundle;

    /**
     * Popularity model.
     *
     * @var Popularity class
     */
    protected $popularity;

    /**
     * Construct
     *
     * @param Book $book
     * @param User $user
     * @param FileBook $filebook
     */
    public function __construct(Book $book, BookBundle $bookbundle, User $user,
                                BookAuthor $bookauthor, Bundle $bundle, Popularity $popularity)
    {
        $this->book = $book;
        $this->user = $user;
        $this->bookbundle = $bookbundle;
        $this->bookauthor = $bookauthor;
        $this->bundle = $bundle;
        $this->popularity = $popularity;
    }

    /**
     * Show page list bundle.
     * @return [type] [description]
     */
    public function bundles() {
        $bundles = $this->user->find(Auth::user()->id)->bundles()->get();
        return view('frontend.bundle.list_bundle', compact('bundles'));
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
          return redirect()->route('new_bundle')->withErrors($validator, 'newbundle')->withInput();
        }

        $bundle = $this->bundle->addNewBundle($request->all());
        return redirect()->route('bundles');
    }

    /**
     * Edit bundle
     * @return [type] [description]
     */
    public function editBundle($id) {
    	$bundle = $this->bundle->find($id);
    	$bookbundles = $this->bookbundle->where('bundle_id',$id)->get();

    	return view('frontend.bundle.edit_bundle', compact('bundle', 'bookbundles'));
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
          return redirect()->route('edit_bundle', $id)->withErrors($validator, 'bundle')->withInput();
        }

        $bundle = $this->bookbundle->updateBundle($request->all(),$id);
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
          return redirect()->route('edit_bundle', $bundleid)->withErrors($validator, 'bundle')->withInput();
        }

    	$bookid = $this->book->where('bookurl', $request->input('bookurl'))->first()->id;
    	$accepted = 0;

    	if ($this->bookauthor->checkAuthorAndMain(Auth::user()->id, $bookid)) {
    		$accepted = 1;
    	}

    	$this->bookbundle->create([
    		'book_id' => $bookid,
    		'bundle_id' => $bundleid,
    		'royalty' => $request->input('royalty'),
    		'accepted' => $accepted
    	]);
    	return redirect()->route('edit_bundle', $bundleid);
    }

    /**
     * Delete book from bundle.
     * @param  Request $request  [description]
     * @param  [type]  $bundleid [description]
     * @return [type]            [description]
     */
    public function deleteBookFromBundle(Request $request, $bundleid, $bookBundleId) {
        $this->bookbundle->find($bookBundleId)->delete();
        return redirect()->route('edit_bundle', $bundleid);
    }

    /**
     * Delete bundle.
     * @param  Request $request [description]
     * @param  [type]  $bundleid  Bundle need delete
     * @return [type]           [description]
     */
    public function deleteBundle(Request $request, $bundleid) {
        $this->bundle->deleteBundleAndRelation($bundleid);
        return redirect()->route('bundles');
    }

    /**
     * Publish bundle.
     * @param  Request $request  [description]
     * @param  [type]  $bundleid [description]
     * @return [type]            [description]
     */
    public function publishBundle(Request $request, $bundleid) {
        $this->bundle->find($bundleid)->update([
          'is_published' => 1,
          'published_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->route('bundles');
    }

    /**
     * Bundle detail.
     * @param  [string] $bundleUrl Short url of bundle.
     * @return [type]
     */
    public function bundleDetail($bundleUrl) {
       $bundle = $this->bundle->bundleDetail($bundleUrl);
       $this->countViewBundle($bundle->id);
       return view('frontend.bundle.bundle_detail', compact('bundle'));
    }

    /**
     * Count view bundle.
     * @param  int $bundleId Id of bundle.
     * @return [type]         [description]
     */
    public function countViewBundle($bundleId) {
        $user = Auth::user();
        if ($user) {
          $this->popularity->create([
            'identity' => $user->id,
            'action' => 1,
            'item_id' => $bundleId,
            'type' => Popularity::TYPE_BUNDLE
          ]);
        } else {
          $this->popularity->create([
            'identity' => \Request::ip(),
            'action' => 1,
            'item_id' => $bundleId,
            'type' => Popularity::TYPE_BUNDLE
          ]);
        }
    }
}
