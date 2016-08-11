<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class Repository implements RepositoryInterface
{
    /**
     * Container.
     *
     * @var Container
     */
    private $app;

    /**
     * Model.
     *
     * @var Model
     */
    protected $model;

    /**
     * Constructor class.
     *
     * @param App $app Container
     *
     * @throws \Bosnadev\Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * This function use get all Eloquent.
     *
     * @param array $columns Collumn get Eloquent
     *
     * @return array Eloquent
     */
    public function all($columns = array('*'))
    {
        return $this->model->all($columns);
    }

    /**
     * This function use delete Eloquent.
     *
     * @param int $id Id of Eloquent
     *
     * @return Eloquent
     */
    public function delete($id)
    {
        return $this->model->delete($id);
    }

    /**
     * This function use find Eloquent.
     *
     * @param int   $id      Id of Eloquent
     * @param array $columns Columns find
     *
     * @return Eloquent
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * This function use find by attribute.
     *
     * @param string $attribute Attribute of Eloquent
     * @param string $value     Value of Eloquent
     * @param array  $columns   Columns of Eloquent
     *
     * @return Eloquent
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, $value)->first($columns);
    }

    /**
     * This function use find list Eloquent.
     *
     * @param string $attribute Attribute of Eloquent
     * @param string $value     Value of Attribute
     * @param array  $columns   Columns of Eloquent
     *
     * @return array Eloquent
     */
    public function findListBy($attribute, $value, $columns = array())
    {
        return $this->model->where($attribute, $value)->get($columns);
    }

    /**
     * This function use create Model.
     *
     * @param array $input Data
     *
     * @return Eloquent
     */
    public function save(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * This function use update Eloquent.
     *
     * @param array  $input     Data
     * @param int    $id        Id of Eloquent
     * @param string $attribute Attribute of Eloquent
     *
     * @return Eloquent
     */
    public function update(array $input, $id, $attribute = 'id')
    {
        return $this->model->where($attribute, '=', $id)->update($input);
    }

    /**
     * Make Model.
     *
     * @return Model
     *
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()}"
            . " must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    abstract public function model();
    
}
