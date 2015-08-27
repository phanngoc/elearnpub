<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Book;
use Validator;

class BookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $bookpublish = Book::getBookPublished();
        $bookunpublish = Book::getBookUnPublished();
        return view('frontend.book',compact('bookpublish','bookunpublish'));
    }

    /**
     * [bookNew description]
     * @return [type] [description]
     */
    public function newBook()
    {
        return view('frontend.book.new_book');
    }

    /**
     * [postBookNew description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postNewBook(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'bookurl' => 'required',
        ]);
        if($validator->fails())
        {
          return redirect()->route('new_book')->withErrors($validator,'newbook')->withInput();  
        }
        $book = Book::addNewBook($request->all());
        return redirect()->route('settingbook',$book->id);
    }

    /**
     * [add_wishlist description]
     * @param [type] $id [description]
     */
    public function add_wishlist($id)
    {
        User::addBookToWishlist($id);
        return redirect('wishlist');
    }

    /**
     * [delete_wishlist description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete_wishlist($id)
    {
        User::removeBookFromWishlist($id);
        return redirect('wishlist');        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
