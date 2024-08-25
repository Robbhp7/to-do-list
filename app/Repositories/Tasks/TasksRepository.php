<?php

namespace App\Repositories\Tasks;

use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

//Models
use App\Models\Tasks\Task;
use Carbon\Carbon;

class TasksRepository extends Repository
{
    /**
     * Main Model class.
     *
     * @var string
     */
    protected $model = Task::class;


    /**
     * This function prepares extra data during creation/updating records.
     * @param array $data
     * @param array $options
     * @return array
     */
    protected function prepareData(array $data, array $options = [], string $method)
    {
        if($method == 'update-status')
        {
            $data['completed_at'] = Carbon::now('Europe/London');
        }

        return $data;
    }

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
     * @return \Illuminate\Support\Collection|Task[]
     * @throws \Error
     */
    public function all(array $options = [])
    {
        return parent::all($options);
    }

    /**
     * Search register by ID.
     *
     * @param int $id
     * @param array $options Extra options
     * @return null|Task
     * @throws \Error
     */
    public function find($id, array $options = [])
    {
        return parent::find($id, $options);
    }


    /**
     * Updates a register.
     *
     * @param int $id
     * @param array $data Has all fields to update.
     * @param array $options
     * @return Task
     * @throws \Exception
     * @throws \Throwable
     */
    public function update($id, array $data, array $options = [])
    {
        return parent::update($id, $data, $options);
    }
}
