<?php

namespace App\Repositories\Tasks;

use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

//Models
use App\Models\Tasks\Task;

class TasksRepository extends Repository
{
    /**
     * Main Model class.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Validate if user can create register.
     *
     * @param array $data
     * @return void
     */
    public function canCreate(array $data, array $options = [])
    {
        return true;
    }

    /**
     * Validate if user can update register.
     *
     * @param Task $item
     * @param null|array $data
     * @return void
     */
    public function canUpdate($item, ?array $data = [], array $options = [])
    {
        $this->canCreate($data, $options);
    }

    /**
     * Validate if user can delete register.
     *
     * @param Task $item
     * @return void
     */
    public function canDelete($item, array $options = [])
    {
        $this->canUpdate($item, [], $options);
    }

    /**
     * Creates new register.
     *
     * @param array $data Data to insert into the table.
     * @return Task
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data, array $options = [])
    {
        return parent::create($data, $options);
    }

    /**
     * Gets all registers.
     *
     * @param array
     * @return \Illuminate\Support\Collection|Audit[]
     * @throws \Error
     */
    public function all(array $options = [])
    {
        return parent::all($options);
    }

}
