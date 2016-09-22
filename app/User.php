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
    protected $fillable = ['username', 'firstname', 'lastname', 'email', 'role_id', 'avatar',
                          'blurb', 'twitter_id', 'github', 'googleplus', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Relation one to many.
     * @return [type] [description]
     */
    public function bills() {
        return $this->hasMany('App\Models\Bill', 'user_id', 'id');
    }

    /**
     * Relation one to many.
     * @return [type] [description]
     */
    public function bundles() {
        return $this->hasMany('App\Models\Bundle', 'user_id', 'id');
    }

    /**
     * Relation many to one.
     * @return [type] [description]
     */
    public function role() {
      return $this->belongsTo('App\Models\Role', 'role_id', 'id');
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
     * Get user by username.
     * @param  [string] $username [description]
     * @return [type]           [description]
     */
    public function getUserByUsername($username)
    {
        return self::where('username', $username)->first();
    }

    /**
     * [book description]
     * @return [type] [description]
     */
    public function books() {
      return $this->belongsToMany('App\Models\Book', 'book_author', 'author_id', 'book_id');
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
        $user = self::create([
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
     * Update contributor of book.
     * @param  [int] $book_id [description]
     * @param  [array] $data    [description]
     * @param  [type] $avatar  [description]
     * @return [type]          [description]
     */
    public function updateContributorAndConnectBook($authorId, $data, $filename)
    {
        self::find($authorId)->update([
            'lastname'   => $data['name'],
            'blurb'      => $data['blurb'],
            'email'      => $data['email'],
            'twitter_id' => $data['twitter_id'],
            'github'     => $data['github'],
            'avatar'     => $filename
        ]);
    }

    /**
     * Show book of unpublic book.
     *
     * @param type $query description
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBookUnPublish($query)
    {
        $query->join('book_author', 'book_author.author_id', '=', 'users.id')
              ->join('books', 'books.id', '=', 'book_author.book_id')
              ->where('book_author.is_main', 1)
              ->where('books.is_published', 0)
              ->where('users.id', $this->id)
              ->select(['books.id', 'books.title', 'books.bookurl', 'books.diravatar']);
        return $query;
    }

    /**
     * Show book of publish book.
     *
     * @param type $query description
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBookPublish($query)
    {
        $query->join('book_author', 'book_author.author_id', '=', 'users.id')
              ->join('books', 'books.id', '=', 'book_author.book_id')
              ->where('book_author.is_main', 1)
              ->where('books.is_published', 1)
              ->where('users.id', $this->id)
              ->select(['books.id', 'books.title', 'books.bookurl', 'books.diravatar']);
        return $query;
    }

}
