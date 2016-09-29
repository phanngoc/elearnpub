<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use Hash;
use DB;
use Auth;
use App\User;

class UserRepository extends BaseRepository
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
     * Fetch all user.
     * @return [type] [description]
     */
    public function listUser() {
        return $this->model->with('role')->paginate(3);
    }

    /**
     * Get auth user.
     * @return [type] [description]
     */
    public function authUser() {
        if (Auth::user() == null) {
          return null;
        } else {
          return $this->model->with('role')->find(Auth::user()->id);
        }
    }
}
