<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Declare function find by id.
     *
     * @param int   $id      Id of Model
     * @param array $columns Array column
     *
     * @return Eloquent
     */
    public function find($id, $columns = array('*'));

    /**
     * Declare function get all Model.
     *
     * @param array $columns Array columns
     *
     * @return array Array Eloquent
     */
    public function all($columns = array('*'));

    /**
     * Declare function find by Attribute.
     *
     * @param string $attribute Attribute find
     * @param string $value     Value of Attribute
     * @param array  $columns   Array column
     *
     * @return Eloquent Eloquent
     */
    public function findBy($attribute, $value, $columns = array('*'));

    /**
     * Declare function find by Attribute.
     *
     * @param string $attribute Attribute find
     * @param string $value     Value of Attribute
     * @param array  $columns   Array column
     *
     * @return array Eloquents
     */
    public function findListBy($attribute, $value, $columns = array('*'));

    /**
     * This function use for save Eloquent.
     *
     * @param array $input Data
     *
     * @return \Illuminate\Database\Eloquent
     */
    public function save(array $input);

    /**
     * This function use for update Eloquent.
     *
     * @param array  $input     Data
     * @param int    $id        Id of Eloquent
     * @param string $attribute Attribute of Eloquent
     *
     * @return \Illuminate\Database\Eloquent
     */
    public function update(array $input, $id, $attribute = 'id');

    /**
     * This function use for delete Eloquent.
     *
     * @param int $id ID of Eloquent
     *
     * @return \Illuminate\Database\Eloquent
     */
    public function delete($id);
}
