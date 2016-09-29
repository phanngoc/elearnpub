<?php
namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;
use DB;
use File;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;

class UserController extends AdminController
{
  private $userRepository;

  private $roleRepository;

  function __construct(UserRepository $userRepository, RoleRepository $roleRepository) {
    $this->userRepository = $userRepository;
    $this->roleRepository = $roleRepository;
  }

  /**
   * Return list user.
   * @return [type] [description]
   */
  public function listUsers() {
    $pagiListUsers = $this->userRepository->listUser();
    $results = array(
      'items' => $pagiListUsers->items(),
      'currentPage' => $pagiListUsers->currentPage(),
      'total' => $pagiListUsers->total()
    );
    return $this->responseSuccess(200, $results);
  }

  /**
   * Edit user.
   * @param  [int] $id.
   * @return [type]     [description]
   */
  public function edit($id) {
    $results = $this->userRepository->with(['role'])->find($id);
    return $this->responseSuccess(200, $results);
  }

  /**
   * Update user.
   * @param  [int] $id.
   * @return [type]     [description]
   */
  public function update($id, Request $request) {
    $input = $request->all();
    unset($input['role']);
    unset($input['created_at']);
    unset($input['updated_at']);
    $results = $this->userRepository->update($input, $id);
    return $this->responseSuccess(200, $results);
  }

  /**
   * List roles.
   * @param  [int] $id.
   * @return [type]     [description]
   */
  public function listRoles() {
    $results = $this->roleRepository->all();
    return $this->responseSuccess(200, $results);
  }

  /**
   * Identity user.
   * @param  [int] $id.
   * @return [type]     [description]
   */
  public function identity() {
    $results = $this->userRepository->authUser();
    if ($results == null) {
      $this->responseError(403, $results);
    } else {
      $this->responseSuccess(200, $results);
    }
  }

  /**
   * Login user.
   * @param  [int] $id.
   * @return [type]     [description]
   */
  public function login(Request $request) {
    $results = false;
    if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
      $results = $this->userRepository->authUser();
      return $this->responseSuccess(200, $results);
    }
    return $this->responseError(403, $results);
  }

  /**
   * Login user.
   * @param  [int] $id.
   * @return [type]     [description]
   */
  public function logout(Request $request) {
    $results = true;
    Auth::logout();
    return $this->responseSuccess(200, $results);
  }
}
