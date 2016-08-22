<?php

namespace App\Repositories;

use App\Repositories\Repository;
use Hash;
use DB;
use Auth;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use ImageHelper;
use App\Models\SocialAccount;
use Mail;
use App\Models\ArnInfo;
use InfoHelper;
use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Advertise;

class UserRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Add book to wishlist.
     * @param [type] $book_id [description]
     */
    public function addBookToWishlist($book_id)
    {
        $user_id = Auth::user()->id;
        $existUserWish = DB::table('book_wishlist')
            ->where('user_id', '=', $user_id)
            ->where('book_id', '=', $book_id)->get();

        if(count($existUserWish) == 0)
        {
            DB::table('book_wishlist')->insert(
                ['book_id' => $book_id, 'user_id' => $user_id]
            );
        }
    }

    /**
     * Get my wishlist.
     * @return [type] [description]
     */
    public function getWishList()
    {
        $user_id = Auth::user()->id;
        $wishlist = DB::table('book_wishlist')->join('books', 'books.id', '=', 'book_wishlist.book_id')
                    ->where('user_id', '=', $user_id)->get();
        return $wishlist;
    }

    /**
     * Remove book from wishlist.
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function removeBookFromWishlist($bookId)
    {
        $user_id = Auth::user()->id;
        DB::table('book_wishlist')->where('user_id', '=', $bookId)
            ->where('book_id', '=', $book_id)->delete();
    }

    /**
     * [getUserByUsername description]
     * @param  [type] $username [description]
     * @return [type]           [description]
     */
    public function getUserByUsername($username)
    {
        return User::where('username',$username)->first();
    }

    /**
     * [book description]
     * @return [type] [description]
     */
    public function books() {
      return $this->belongsToMany('App\Models\Book','book_author','author_id','book_id');
    }

    /**
     * Connect collaborator to book.
     * @param  [array] $data
     * @param  [int] $book_id  [description]
     * @return [bool]           [description]
     */
    public function connectCoAuthor($data, $book_id)
    {
        $coAuthor = User::where('username', $data['username'])->first();
        if($coAuthor != null)
        {
            DB::table('book_author')->insert([
                'author_id' => $coAuthor->id,
                'book_id' => $book_id,
                'is_main' => 0,
                'royalty' => $data['royalty'],
                'is_accepted' => 0,
                'message' => $data['message']
            ]);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Create contributor and connect to book.
     * @param  [int] $book_id Id of book.
     * @param  [type] $data    [description]
     * @param  [type] $avatar  [description]
     * @return [type]          [description]
     */
    public function createContributorAndConnectBook($book_id, $data, $avatar)
    {
        $user = $this->model->create([
            'lastname' => $data['name'],
            'blurb' => $data['blurb'],
            'email' => $data['email'],
            'twitter_id' => $data['twitter_id'],
            'github' => $data['github'],
            'avatar' => $avatar
        ]);

        DB::table('book_author')->insert([
            'author_id' => $user->id,
            'book_id' => $book_id,
            'is_main' => 2,
            'royalty' => 0,
            'is_accepted' => 1,
            'message' => ''
        ]);
    }

    /**
     * [updateContributorAndConnectBook description]
     * @param  [type] $book_id [description]
     * @param  [type] $data    [description]
     * @param  [type] $avatar  [description]
     * @return [type]          [description]
     */
    public function updateContributorAndConnectBook($authorId, $data, $filename)
    {
        User::find($authorId)->update([
            'lastname'   => $data['name'],
            'blurb'      => $data['blurb'],
            'email'      => $data['email'],
            'twitter_id' => $data['twitter_id'],
            'github'     => $data['github'],
            'avatar'     => $filename
        ]);
    }
}
