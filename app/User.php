<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Models\Book;
use Auth;
use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'firstname', 'lastname','email','role_id','avatar','blurb','twitter_id','github','googleplus','remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function addBookToWishlist($book_id)
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
    public static function getWishList()
    {
        $user_id = Auth::user()->id;
        $wishlist = DB::table('book_wishlist')->join('books', 'books.id', '=', 'book_wishlist.book_id')
            ->where('user_id', '=', $user_id)->get();
        return $wishlist;
    }
    public static function removeBookFromWishlist($book_id)
    {
        $user_id = Auth::user()->id;
        DB::table('book_wishlist')->where('user_id', '=', $user_id)
            ->where('book_id', '=', $book_id)->delete();
    }
}
