<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Book;
use App\Models\Common;

class BookRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Book::class;
    }

    /**
     * Fetch all books.
     * @return [type] [description]
     */
    public function listBooks() {
        return $this->model->with(['authors' => function($query) {
            return $query->where('is_main', Common::AUTHOR_MAIN);
        }, 'categories', 'bundles', 'packages'])->paginate(3);
    }

    /**
     * Get book with category.
     * @return [type] [description]
     */
    public function findBookWithCategories($bookId) {
        return $this->model->with(['categories'])->find($bookId);
    }

    /**
     * Sync book with categories with many to many.
     * @param  [array] $arr Array category id.
     * @return [array]      $Ids
     */
    public function syncCategories($bookId, $arr) {
        return $this->model->find($bookId)->categories()->sync($arr);
    }

    /**
  	 * Find all author who write book with book_id
  	 * @param  [type] $bookId [description]
  	 * @return [type]          [description]
  	 */
  	public function findBookWithMainAndCoAuthor($bookId)
  	{
      $coauthor = $this->model->with(['authors' => function($query) {
         $query->where('is_main', '!=', Common::AUTHOR_CONTRIBUTE);
      }])->find($bookId);

  		return $coauthor;
  	}

    /**
     * Connect collaborator to book.
     * @param  [array] $data
     * @param  [int] $book_id  [description]
     * @return [bool]           [description]
     */
    public function syncCoAuthorToBook($data, $bookId)
    {
        $relationAuthors = $this->model->find($bookId)->authors_initial();
        $relationAuthors->detach($data['author_id']);
        return $relationAuthors->sync([$bookId => array(
                  'author_id' => $data['author_id'],
                  'book_id' => $bookId,
                  'is_main' => 0,
                  'royalty' => $data['royalty'],
                  'is_accepted' => 0,
                  'message' => $data['message']
              )], false);
    }

    /**
     * Connect contributor to book.
     * @param  [array] $data
     * @param  [int] $book_id  [description]
     * @return [bool]           [description]
     */
    public function syncContributeToBook($userId, $bookId)
    {
        $relationAuthors = $this->model->find($bookId)->authors_initial();
        $relationAuthors->detach($userId);
        return $relationAuthors->sync([$bookId => array(
                  'author_id' => $userId,
                  'book_id' => $bookId,
                  'is_main' => Common::AUTHOR_CONTRIBUTE,
                  'royalty' => 0,
                  'is_accepted' => Common::AUTHOR_ACCEPT,
                  'message' => ''
              )], false);
    }
}
