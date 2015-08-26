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

    /**
     * [addBookToWishlist description]
     * @param [type] $book_id [description]
     */
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

    /**
     * [getWishList description]
     * @return [type] [description]
     */
    public static function getWishList()
    {
        $user_id = Auth::user()->id;
        $wishlist = DB::table('book_wishlist')->join('books', 'books.id', '=', 'book_wishlist.book_id')
            ->where('user_id', '=', $user_id)->get();
        return $wishlist;
    }

    /**
     * [removeBookFromWishlist description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public static function removeBookFromWishlist($book_id)
    {
        $user_id = Auth::user()->id;
        DB::table('book_wishlist')->where('user_id', '=', $user_id)
            ->where('book_id', '=', $book_id)->delete();
    }

    /**
     * [getUserByUsername description]
     * @param  [type] $username [description]
     * @return [type]           [description]
     */
    public static function getUserByUsername($username)
    {
        return User::where('username',$username)->first();
    }

    /**
     * [book description]
     * @return [type] [description]
     */
    public function book() {
      return $this->belongsToMany('App\Models\Book','book_author','author_id','book_id');
    }

    /**
     * [connectCoAuthor description]
     * @param  [type] $username [description]
     * @param  [type] $book_id  [description]
     * @return [type]           [description]
     */
    public static function connectCoAuthor($data,$book_id)
    {
        $coAuthor = User::where('username',$data['username'])->first();
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
        }
        else
        {
            return false;
        }
    }

    /**
     * [createContributorAndConnectBook description]
     * @param  [type] $book_id [description]
     * @param  [type] $data    [description]
     * @param  [type] $avatar  [description]
     * @return [type]          [description]
     */
    public static function createContributorAndConnectBook($book_id,$data,$avatar)
    {
        $user = User::create([
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
    public static function updateContributorAndConnectBook($author_id,$data,$filename)
    {
        User::find($author_id)->update([
            'lastname'   => $data['name'],
            'blurb'      => $data['blurb'],
            'email'      =>  $data['email'],
            'twitter_id' => $data['twitter_id'],
            'github'     => $data['github'],
            'avatar'     => $filename
        ]);
    }

}
