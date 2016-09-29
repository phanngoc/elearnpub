<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\BookRepository;

class BookService
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

  /**
   * Create contributor and connect to book.
   * @param  [int] $book_id Id of book.
   * @param  [array] $data    [description]
   * @param  [type] $avatar  [description]
   * @return [type]          [description]
   */
  public function createContributorAndConnectBook($bookId, $data)
  {
      $user = $this->userRepository->create([
          'lastname' => $data['name'],
          'blurb' => $data['blurb'],
          'email' => $data['email'],
          'twitter_id' => $data['twitter_id'],
          'github' => $data['github'],
          'avatar' => $data['avatar']
      ]);
      $this->bookRepository->syncContributeToBook($user->id, $bookId);
  }

  /**
   * Update contributor and connect to book.
   * @param  [int] $bookId Id of book.
   * @param  [array] $data    [description]
   * @param  [type] $avatar  [description]
   * @return [type]          [description]
   */
  public function updateContributorAndConnectBook($bookId, $authorId, $data)
  {
      $user = $this->userRepository->update([
          'lastname' => $data['name'],
          'blurb' => $data['blurb'],
          'email' => $data['email'],
          'twitter_id' => $data['twitter_id'],
          'github' => $data['github'],
          'avatar' => $data['avatar']
      ], $authorId);
      $this->bookRepository->syncContributeToBook($user->id, $bookId);
  }

  /**
   * Create contributor by username.
   * @param [int] $bookId  [description]
   * @param [strings] $username [description]
   */
  public function createContributorByUsername($bookId, $username)
  {
    $user = $this->userRepository->findByField('username', $username)->first();
    if($user != null)
    {
      $this->bookRepository->syncContributeToBook($user->id, $bookId);
    }
  }

}
