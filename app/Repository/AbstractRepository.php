<?php


namespace App\Repository;


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

    public function find (int $id)
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
}
