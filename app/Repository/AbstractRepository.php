<?php


namespace App\Repository;


use PHPUnit\Exception;

class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->init();
    }

    protected function init()
    {
        if ($this->class) {
            return $this->model = app()->make($this->class);
        }
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create($options)
    {
        return $this->model->create($options);
    }

    public function select(string $string)
    {
        return $this->model->select($string);
    }

    public function updateWithoutLoading(int $id, array $options)
    {
        return $this->model->where('id', $id)->update($options);
    }

    public function getAllRecords()
    {
        return $this->model->all();
    }

    public function paginate(int $paginateCount)
    {
        return $this->model->paginate($paginateCount);
    }

    public function firstOrCreate(array $options)
    {
        return $this->model->firstOrCreate($options);
    }

    public function save($model)
    {
        $model->update();

        return $model->refresh();
    }
}
