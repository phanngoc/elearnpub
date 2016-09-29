<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\BookAuthor;

class BookAuthorRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return BookAuthor::class;
    }

    /**
     * Delete collaborator author of book.
     * @param  [type] $bookId   [description]
     * @param  [type] $authorId [description]
     * @return [type]           [description]
     */
    public function deleteCoAuthor($bookId, $authorId) {
        return $this->model->where('book_id', $book_id)
                   ->where('author_id', $author_id)
                   ->where('is_main', 0)->delete();
    }
}
