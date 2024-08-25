<?php

namespace App\Repositories;

use Eloquent;
use Error;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class Repository
{

    /**
     * Main model for the repository.
     *
     * @var string
     */
    protected $model;

    /**
     * @var \Eloquent
     */
    protected $modelInstance;

    public function __construct()
    {
        // Instance of model is created
        $this->modelInstance = new $this->model;
    }

    /*.
     *
     * @param array $options Extra options to filter/add
     * @return Builder
     * @throws Error
     */
    public function query(array $options = []): Builder
    {
        $query = $this->modelInstance->query();

        $this->handleOptions($query, $options);

        return $query;
    }

    /**
     * Add options to filter.
     *
     * @param Builder $builder
     * @param array $options
     * @return Builder
     */
    public function handleOptions(Builder $builder, array $options = []): Builder
    {
        return $builder;
    }

    /**
     * Gets all registers.
     *
     * @param array $options
     * @return Collection
     * @throws Error
     */
    public function all(array $options = [])
    {
        $query = $this->query($options);

        return $query->get();
    }

    /**
     * Validate if user can create register.
     *
     * @param array $data
     * @return void
     */
    public function canCreate(array $data, array $options = [])
    {
        //
    }

    /**
     * Creates new register.
     *
     * @param array $data Data to insert into the table.
     * @return Eloquent
     * @throws Exception
     * @throws Throwable
     */
    public function create(array $data, array $options = [])
    {
        DB::beginTransaction();
        try {
            $item = (new $this->model);

            $item->fill($data)->save();

            DB::commit();

            return $item;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
