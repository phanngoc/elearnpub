<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Role;

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
     * Fetch all user.
     * @return [type] [description]
     */
    public function listBooks() {
        return $this->model->with(['author', 'category'])->paginate(3);
    }
}
