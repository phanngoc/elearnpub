<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class WishlistController extends Controller
{
    /**
     * User model.
     *
     * @var User class
     */
    protected $user;

    /**
     * Construct
     *
     * @param Book $book
     * @param User $user
     * @param FileBook $filebook
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $wishlist = $this->user->getWishList();
        return view('frontend.wishlist',compact('wishlist'));
    }

    /**
     * [add_wishlist description]
     * @param [type] $id [description]
     */
    public function add_wishlist($id)
    {
        $this->user->addBookToWishlist($id);
        return redirect('wishlist');
    }

    public function delete_wishlist($id)
    {
        $this->user->removeBookFromWishlist($id);
        return redirect('wishlist');
    }

}
