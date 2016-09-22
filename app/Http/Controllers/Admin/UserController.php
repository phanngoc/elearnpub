<?php
namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;
use DB;
use File;
use Validator;
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
    return $this->responeSuccess(200, $results);
  }

  /**
   * Edit user.
   * @param  [int] $id.
   * @return [type]     [description]
   */
  public function edit($id) {
    $results = $this->userRepository->with(['role'])->find($id);
    return $this->responeSuccess(200, $results);
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
    return $this->responeSuccess(200, $results);
  }

  /**
   * List roles.
   * @param  [int] $id.
   * @return [type]     [description]
   */
  public function listRoles() {
    $results = $this->roleRepository->all();
    return $this->responeSuccess(200, $results);
  }
}
