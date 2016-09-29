<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\BookRepository;

class UserRepository extends Repository
{
  /**
   * Book Repository.
   */
  protected $bookRepository;

  /**
   * User Repository.
   */
  protected $userRepository;

  /**
   * Construct.
   * @param BookRepository $bookRepository [description]
   * @param UserRepository $userRepository [description]
   */
  public function __construct(BookRepository $bookRepository, UserRepository $userRepository)
  {
    $this->bookRepository = $bookRepository;
    $this->userRepository = $userRepository;
  }
}
