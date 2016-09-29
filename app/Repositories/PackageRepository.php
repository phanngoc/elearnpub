<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Package;

class PackageRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Package::class;
    }

    /**
     * Get package also it's extra.
     * @param  [int] $packageId Id of package.
     * @return [type]            [description]
     */
    public function getPackageWithExtras($packageId)
    {
        return $this->model->with('extras')->find($packageId);
    }

    /**
     * Delete package.
     * @param  [int] $package_id [description]
     * @return [type]             [description]
     */
    public function deletePackage($packageId)
    {
      $extras = Extra::where('package_id',$package_id)->get();
      foreach ($extras as $key => $value) {
        Extrafile::where('extra_id',$value->id)->where('is_attached',1)->delete();
        Extra::find($value->id)->delete();
      }
      $this->model->delete($packageId);
    }
}
